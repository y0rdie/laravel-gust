window.Http = require('./services/Http').default;
window.Form = require('./services/Form').default;

import { createApp } from 'vue';
import App from '@layouts/App';
import registerPlugins from '@plugins';

const app = createApp(App);

registerPlugins(app);

app.mount('#app');
