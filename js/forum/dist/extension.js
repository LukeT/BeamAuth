System.register('luket/beamauth/main', ['flarum/extend', 'flarum/app', 'flarum/components/LogInButtons', 'flarum/components/LogInButton'], function (_export) {
  'use strict';

  var extend, app, LogInButtons, LogInButton;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumApp) {
      app = _flarumApp['default'];
    }, function (_flarumComponentsLogInButtons) {
      LogInButtons = _flarumComponentsLogInButtons['default'];
    }, function (_flarumComponentsLogInButton) {
      LogInButton = _flarumComponentsLogInButton['default'];
    }],
    execute: function () {

      app.initializers.add('luket-beamauth', function () {
        extend(LogInButtons.prototype, 'items', function (items) {
          items.add('beam', m(
            LogInButton,
            {
              className: 'Button LogInButton--beam',
              icon: 'circle',
              path: '/auth/beam' },
            'Log in with Beam'
          ));
        });
      });
    }
  };
});