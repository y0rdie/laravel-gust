import guest from './middleware/guest';
import authenticated from './middleware/authenticated';
import verified from './middleware/verified';
import confirmed from './middleware/confirmed';

export default [
    { path: '/', component: require('@pages/Welcome').default, name: 'welcome' },
    { path: '/register', component: require('@pages/Auth/Register').default, name: 'register', meta: { middleware: guest } },
    { path: '/login', component: require('@pages/Auth/Login').default, name: 'login', meta: { middleware: guest } },
    { path: '/forgot-password', component: require('@pages/Auth/ForgotPassword').default, name: 'password.request', meta: { middleware: guest } },
    { path: '/reset-password/:token', component: require('@pages/Auth/ResetPassword').default, name: 'password.reset', meta: { middleware: guest } },
    { path: '/verify-email', component: require('@pages/Auth/VerifyEmail').default, name: 'verification.notice', meta: { middleware: authenticated } },
    { path: '/confirm-password', component: require('@pages/Auth/ConfirmPassword').default, name: 'password.confirm', meta: { middleware: authenticated } },
    { path: '/logout', component: require('@pages/Auth/Logout').default, name: 'logout', meta: { middleware: authenticated } },
    { path: '/dashboard', component: require('@pages/Dashboard').default, name: 'dashboard', meta: { middleware: [ authenticated, verified ] } },
    { path: '/settings', component: require('@pages/Settings').default, name: 'settings', meta: { middleware: [ authenticated, verified, confirmed ] } },
];
