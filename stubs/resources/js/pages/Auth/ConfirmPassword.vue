<template>
    <guest-layout>
        <base-auth-card>
            <template v-slot:logo>
                <router-link :to="{ name: 'welcome' }" >
                    <base-application-logo class="w-20 h-20 fill-current text-gray-500"></base-application-logo>
                </router-link>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <!-- Validation Errors -->
            <base-auth-validation-errors v-if="Object.keys(form.errors.errors).length > 0" class="mb-4" :errors="form.errors.errors"></base-auth-validation-errors>

            <!-- Password -->
            <div>
                <base-label for="password" value="Password" />

                <base-input v-model="form.password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <base-button @click="confirm">
                    Confirm
                </base-button>
            </div>
        </base-auth-card>
    </guest-layout>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                password: null,
            }, async form => {
                await Http.post('/user/confirm-password', form);

                this.$auth.commit('SET_CONFIRMED');
                this.$router.push({ name: this.$route.query.intended });
            }),
        }
    },
    methods: {
        confirm() {
            this.form.submit().catch(error => {});
        },
    },
}
</script>
