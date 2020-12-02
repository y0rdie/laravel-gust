import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const auth = new Vuex.Store({
    state: {
        checked: false,
        authenticated: false,
        user: null,
    },
    getters: {
        checked: state => {
            return state.checked;
        },
        authenticated: state => {
            return state.authenticated;
        },
        verified: (state, getters) => {
            return getters.authenticated
                && state.user.email_verified_at !== null;
        },
        confirmed: (state, getters) => {
            return getters.authenticated
                && ! getters.confirmExpired;
        },
        confirmExpired: (state, getters) => {
            if (! getters.authenticated) {
                return false;
            }

            const timeSinceConfirmed = (Date.now() / 1000) - state.user.password_confirmed_at;

            return timeSinceConfirmed > 10800;
        },
    },
    mutations: {
        SET_CHECKED (state, value) {
            state.checked = value;
        },
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value;
        },
        SET_USER (state, user) {
            state.user = user !== '' ? user : null;
        },
        SET_CONFIRMED (state) {
            state.user.password_confirmed_at = Math.round(Date.now() / 1000);
        },
        REMOVE_USER (state) {
            state.user = null;
        },
    },
    actions: {
        async me (context) {
            await Http.get('/api/user')
                .then(user => {
                    context.commit('SET_AUTHENTICATED', true);
                    context.commit('SET_USER', user);
                })
                .catch(error => {
                    context.commit('SET_AUTHENTICATED', false);
                    context.commit('SET_USER', null);
                });

            context.commit('SET_CHECKED', true);
        },
    },
});
