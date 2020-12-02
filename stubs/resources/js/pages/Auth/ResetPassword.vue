<template>
    <guest-layout>
        <base-auth-card>
            <template v-slot:logo>
                <router-link :to="{ name: 'welcome' }" >
                    <base-application-logo class="w-20 h-20 fill-current text-gray-500"></base-application-logo>
                </router-link>
            </template>

            <!-- Validation Errors -->
            <base-auth-validation-errors v-if="Object.keys(form.errors.errors).length > 0" class="mb-4" :errors="form.errors.errors"></base-auth-validation-errors>

            <!-- Email Address -->
            <div>
                <base-label for="email" value="Email" />

                <base-input v-model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" value="" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">
                    Password
                </label>

                <base-input v-model="form.password" id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">
                    Confirm Password
                </label>

                <base-input v-model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <base-button @click="reset">
                    Reset Password
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
                token: this.$route.params.token,
                email: this.$route.query.email,
                password: null,
                password_confirmation: null,
            }, async form => {
                await Http.post('/reset-password', form);

                this.$router.push({ name: 'login' });
            }),
        }
    },
    methods: {
        reset() {
            this.form.submit().catch(error => {});
        },
    },
}
</script>
