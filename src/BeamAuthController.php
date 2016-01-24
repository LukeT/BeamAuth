<?php
namespace LukeT\BeamAuth;

use Flarum\Forum\AuthenticationResponseFactory;
use Flarum\Forum\Controller\AbstractOAuth2Controller;
use Flarum\Settings\SettingsRepositoryInterface;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class BeamAuthController extends AbstractOAuth2Controller
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settings;

    /**
     * @param AuthenticationResponseFactory $authResponse
     * @param SettingsRepositoryInterface $settings
     */
    public function __construct(AuthenticationResponseFactory $authResponse, SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
        $this->authResponse = $authResponse;
    }


    protected function getProvider($redirectUri) {
        return new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId'        => $this->settings->get('luket-beamauth.app_id'),
            'clientSecret'    => $this->settings->get('luket-beamauth.app_secret'),
            'redirectUri'     => $redirectUri,
            'urlAuthorize'    => "https://beam.pro/oauth/authorize",
            'urlAccessToken'  => "https://beam.pro/api/v1/oauth/token",
            'urlResourceOwnerDetails' => "https://beam.pro/api/v1/users/current"
        ]);
    }

    protected function getAuthorizationUrlOptions()
    {
        return ['scope' => ['user:details:self']];
    }

    protected function getIdentification(ResourceOwnerInterface $resourceOwner)
    {
         return ['beam_id' => $resourceOwner->toArray()['id']];
    }

    protected function getSuggestions(ResourceOwnerInterface $resourceOwner)
    {
        return [
            'username' => $resourceOwner->toArray()['username'],
            'email' => $resourceOwner->toArray()['email']
        ];
    }
}