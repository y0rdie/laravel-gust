import baseComponents from './base-components';
import stores from './stores';

export default function (Vue) {
    Vue.component('guest-layout', require('@layouts/Guest').default);
    Vue.component('auth-layout', require('@layouts/Auth').default);
    Vue.use(baseComponents);
    Vue.use(stores);
}
