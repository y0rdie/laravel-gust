import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes'
import { auth } from '@stores';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes,
});

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];

    if (! subsequentMiddleware) {
        return context.next;
    }

    return (...parameters) => {
        context.next(...parameters);

        const nextMiddleware = nextFactory(context, middleware, index + 1);

        subsequentMiddleware({ ...context, next: nextMiddleware });
    };
}

router.beforeEach(async (to, from, next) => {
    if (! auth.getters.checked && ! auth.getters.authenticated) {
        await auth.dispatch('me');
    }

    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = { from, next, router, to };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
});

export default router;
