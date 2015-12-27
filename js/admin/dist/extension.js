System.register('luket/beamauth/components/BeamSettingsModal', ['flarum/components/SettingsModal'], function (_export) {
  'use strict';

  var SettingsModal, BeamSettingsModal;
  return {
    setters: [function (_flarumComponentsSettingsModal) {
      SettingsModal = _flarumComponentsSettingsModal['default'];
    }],
    execute: function () {
      BeamSettingsModal = (function (_SettingsModal) {
        babelHelpers.inherits(BeamSettingsModal, _SettingsModal);

        function BeamSettingsModal() {
          babelHelpers.classCallCheck(this, BeamSettingsModal);
          babelHelpers.get(Object.getPrototypeOf(BeamSettingsModal.prototype), 'constructor', this).apply(this, arguments);
        }

        babelHelpers.createClass(BeamSettingsModal, [{
          key: 'className',
          value: function className() {
            return 'BeamSettingsModal Modal--small';
          }
        }, {
          key: 'title',
          value: function title() {
            return 'Beam Settings';
          }
        }, {
          key: 'form',
          value: function form() {
            return [m(
              'div',
              { className: 'Form-group' },
              m(
                'label',
                null,
                'App ID'
              ),
              m('input', { className: 'FormControl', bidi: this.setting('luket-beamauth.app_id') })
            ), m(
              'div',
              { className: 'Form-group' },
              m(
                'label',
                null,
                'App Secret'
              ),
              m('input', { className: 'FormControl', bidi: this.setting('luket-beamauth.app_secret') })
            )];
          }
        }]);
        return BeamSettingsModal;
      })(SettingsModal);

      _export('default', BeamSettingsModal);
    }
  };
});;
System.register('luket/beamauth/main', ['flarum/app', 'luket/beamauth/components/BeamSettingsModal'], function (_export) {
  'use strict';

  var app, BeamSettingsModal;
  return {
    setters: [function (_flarumApp) {
      app = _flarumApp['default'];
    }, function (_luketBeamauthComponentsBeamSettingsModal) {
      BeamSettingsModal = _luketBeamauthComponentsBeamSettingsModal['default'];
    }],
    execute: function () {

      app.initializers.add('luket-beamauth', function () {
        app.extensionSettings['luket-beamauth'] = function () {
          return app.modal.show(new BeamSettingsModal());
        };
      });
    }
  };
});