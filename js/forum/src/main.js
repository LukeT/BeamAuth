import { extend } from 'flarum/extend';
import app from 'flarum/app';
import LogInButtons from 'flarum/components/LogInButtons';
import LogInButton from 'flarum/components/LogInButton';

app.initializers.add('luket-beamauth', () => {
  extend(LogInButtons.prototype, 'items', function(items) {
    items.add('beam',
      <LogInButton
        className="Button LogInButton--beam"
        icon="circle"
        path="/auth/beam">
        Log in with Beam
      </LogInButton>
    );
  });
});
