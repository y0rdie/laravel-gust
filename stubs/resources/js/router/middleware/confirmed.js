import { auth } from '@stores';

export default function confirmed({ next, to, router }) {
    if (! auth.getters.confirmed) {
        return router.push({ name: 'password.confirm', query: { intended: to.name } });
    }

    return next();
}
