import { auth } from '@stores';

export default function verified({ next, to }) {
    if (! auth.getters.verified) {
        next({ name: 'verification.notice' });
    }

    return next();
}
