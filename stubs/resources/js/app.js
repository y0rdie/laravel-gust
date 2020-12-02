window.Vue = require('vue');
window.Http = require('./services/Http').default;
window.Form = require('./services/Form').default;

import router from '@router';
import App from '@layouts/App';
import registerPlugins from '@plugins';

registerPlugins(Vue);

new Vue({
    el: '#app',
    render: h => h(App),
    router,
});
