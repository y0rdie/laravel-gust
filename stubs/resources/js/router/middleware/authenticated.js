import { auth } from '@stores';

export default function authenticated({ next, to, router }) {
    if (! auth.getters.authenticated) {
        return router.push({ name: 'login' });
    }

    return next();
}
