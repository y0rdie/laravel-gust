<template></template>

<script>
export default {
    async created() {
        await Http.post('/logout');
        this.$auth.commit('SET_AUTHENTICATED', false);
        this.$auth.commit('REMOVE_USER');
        this.$router.push({ name: 'login' });
    },
}
</script>
