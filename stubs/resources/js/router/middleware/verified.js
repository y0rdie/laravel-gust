import { auth } from '@stores';

export default function verified({ next, to, router }) {
    if (! auth.getters.verified) {
        return router.push({ name: 'verification.notice' });
    }

    return next();
}
