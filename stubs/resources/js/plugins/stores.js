import { auth } from '@stores';

function addProperty(Vue, property, value) {
    Object.defineProperty(Vue.prototype, property, {
        get () {
            return value;
        }
    });
}

export default {
    install (Vue) {
        addProperty(Vue, '$auth', auth);
    }
}
