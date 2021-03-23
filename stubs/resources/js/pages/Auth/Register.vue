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

            <!-- Name -->
            <div>
                <base-label for="name" value="Name" />

                <base-input v-model="form.name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <base-label for="email" value="Email" />

                <base-input v-model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <base-label for="password" value="Password" />

                <base-input v-model="form.password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <base-label for="password_confirmation" value="Confirm Password" />

                <base-input v-model="form.password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <router-link :to="{ name: 'login' }" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </router-link>

                <base-button @click="register" class="ml-4">
                    Register
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
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            }, async form => {
                await Http.post('/register', form);
                await this.$auth.dispatch('me');

                this.$router.push({ name: 'dashboard' });
            }),
        }
    },
    methods: {
        register() {
            this.form.submit().catch(error => {});
        },
    },
}
</script>
