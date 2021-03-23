import { auth } from '@stores';

export default function guest({ next, to, router }) {
    if (auth.getters.authenticated) {
        return router.push({ name: 'dashboard' });
    }

    return next();
}
