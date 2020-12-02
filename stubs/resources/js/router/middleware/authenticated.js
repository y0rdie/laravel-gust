import { auth } from '@stores';

export default function authenticated({ next, to }) {
    if (! auth.getters.authenticated) {
        next({ name: 'login' });
    }

    return next();
}
