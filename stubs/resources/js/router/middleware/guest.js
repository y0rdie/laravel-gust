import { auth } from '@stores';

export default function guest({ next, to }) {
    if (auth.getters.authenticated) {
        next({ name: 'dashboard' });
    }

    return next();
}
