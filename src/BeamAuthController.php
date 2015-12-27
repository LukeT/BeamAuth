<?php
namespace LukeT\BeamAuth;

use Flarum\Forum\Controller\AuthenticateUserTrait;
use Flarum\Forum\UrlGenerator;
use Flarum\Http\Controller\ControllerInterface;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Bus\Dispatcher;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Diactoros\Response\RedirectResponse;


class BeamAuthController implements ControllerInterface
{
    use AuthenticateUserTrait;

    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @param SettingsRepositoryInterface $settings
     * @param UrlGenerator $url
     * @param Dispatcher $bus
     */
    public function __construct(SettingsRepositoryInterface $settings, UrlGenerator $url, Dispatcher $bus)
    {
        $this->settings = $settings;
        $this->url = $url;
        $this->bus = $bus;
    }

    /**
     * @param Request $request
     * @param array $routeParams
     * @return \Psr\Http\Message\ResponseInterface|RedirectResponse
     */
    public function handle(Request $request, array $routeParams = [])
    {
        session_start();

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'        => $this->settings->get('luket-beamauth.app_id'),
            'clientSecret'    => $this->settings->get('luket-beamauth.app_secret'),
            'redirectUri'     => $this->url->toRoute('auth.beam'),
            'urlAuthorize'    => "https://beam.pro/oauth/authorize",
            'urlAccessToken'  => "https://beam.pro/api/v1/oauth/token",
            'urlResourceOwnerDetails' => "https://beam.pro/api/v1/users/current"
        ]);

        if (! isset($_GET['code'])) {
            $authUrl = $provider->getAuthorizationUrl([
                'scope' => ['user:details:self']
            ]);
            $_SESSION['oauth2state'] = $provider->getState();

            return new RedirectResponse($authUrl);
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            echo 'Invalid state.';
            exit;
        }

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        


        $owner = $provider->getResourceOwner($token);


        $username = preg_replace('/[^a-z0-9-_]/i', '', $owner->toArray()['username']);
        $email = $owner->toArray()['email'];
        $id = $owner->toArray()['id'];
        return $this->authenticate( 
            ['beam_id' => $owner->toArray()['id']],
            ['email' => $owner->toArray()['email']]
        );
    }
}
