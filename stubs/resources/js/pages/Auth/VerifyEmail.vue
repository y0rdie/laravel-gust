<template>
    <guest-layout>
        <base-auth-card>
            <template v-slot:logo>
                <router-link :to="{ name: 'welcome' }" >
                    <base-application-logo class="w-20 h-20 fill-current text-gray-500"></base-application-logo>
                </router-link>
            </template>

            <div class="mb-4 text-sm text-gray-600">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
            </div>

            <div v-if="status === 'verification-link-sent'" class="mb-4 font-medium text-sm text-green-600">
                A new verification link has been sent to the email address you provided during registration.
            </div>

            <div class="mt-4 flex items-center justify-between">
                <div>
                    <base-button @click="send">
                        Resend Verification Email
                    </base-button>
                </div>

                <router-link :to="{ name: 'logout' }" class="underline text-sm text-gray-600 hover:text-gray-900">Logout</router-link>
            </div>
        </base-auth-card>
    </guest-layout>
</template>

<script>
export default {
    data() {
        return {
            status: null,
        }
    },
    methods: {
        async send() {
            this.status = null;

            await Http.post('/email/verification-notification')
                .then(response => this.status = 'verification-link-sent')
                .catch(error => {});
        },
    },
}
</script>
