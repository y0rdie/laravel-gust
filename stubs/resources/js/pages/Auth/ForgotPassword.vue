<template>
    <guest-layout>
        <base-auth-card>
            <template v-slot:logo>
                <router-link :to="{ name: 'welcome' }" >
                    <base-application-logo class="w-20 h-20 fill-current text-gray-500"></base-application-logo>
                </router-link>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>

            <!-- Session Status -->
            <base-auth-session-status v-if="status !== null" class="mb-4" :status="status"></base-auth-session-status>

            <!-- Validation Errors -->
            <base-auth-validation-errors v-if="Object.keys(form.errors.errors).length > 0" class="mb-4" :errors="form.errors.errors"></base-auth-validation-errors>

            <!-- Email Address -->
            <div>
                <base-label for="email" value="Email" />

                <base-input v-model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <base-button @click="send">
                    Email Password Reset Link
                </base-button>
            </div>
        </base-auth-card>
    </guest-layout>
</template>

<script>
export default {
    data() {
        return {
            status: null,
            form: new Form({
                email: null,
            }, async form => {
                await Http.post('/forgot-password', form);

                this.status = 'We have emailed your password reset link!';
            }),
        }
    },
    methods: {
        send() {
            this.status = null;
            this.form.submit().catch(error => {});
        },
    },
}
</script>
