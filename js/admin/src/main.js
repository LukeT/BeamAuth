import app from 'flarum/app';

import BeamSettingsModal from 'luket/beamauth/components/BeamSettingsModal';

app.initializers.add('luket-beamauth', () => {
  app.extensionSettings['luket-beamauth'] = () => app.modal.show(new BeamSettingsModal());
});
