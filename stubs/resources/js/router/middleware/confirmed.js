import { auth } from '@stores';

export default function confirmed({ next, to }) {
    if (! auth.getters.confirmed) {
        next({ name: 'password.confirm', query: { intended: to.name } });
    }

    return next();
}
