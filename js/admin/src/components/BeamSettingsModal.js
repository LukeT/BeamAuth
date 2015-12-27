import SettingsModal from 'flarum/components/SettingsModal';

export default class BeamSettingsModal extends SettingsModal {
  className() {
    return 'BeamSettingsModal Modal--small';
  }

  title() {
    return 'Beam Settings';
  }

  form() {
    return [
      <div className="Form-group">
        <label>App ID</label>
        <input className="FormControl" bidi={this.setting('luket-beamauth.app_id')}/>
      </div>,

      <div className="Form-group">
        <label>App Secret</label>
        <input className="FormControl" bidi={this.setting('luket-beamauth.app_secret')}/>
      </div>
    ];
  }
}
