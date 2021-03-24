import { auth } from '@stores';

function addProperty(app, property, value) {
    Object.defineProperty(app.config.globalProperties, property, {
        get () {
            return value;
        }
    });
}

export default {
    install (app) {
        addProperty(app, '$auth', auth);
    }
}
