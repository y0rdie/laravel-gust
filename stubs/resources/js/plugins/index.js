import baseComponents from './base-components';
import router from '@router';
import stores from './stores';

export default function (app) {
    app
        .component('guest-layout', require('@layouts/Guest').default)
        .component('auth-layout', require('@layouts/Auth').default)
        .use(baseComponents)
        .use(router)
        .use(stores);
}
