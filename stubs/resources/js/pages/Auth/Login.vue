<template>
    <guest-layout>
        <base-auth-card>
            <template v-slot:logo>
                <router-link :to="{ name: 'welcome' }" >
                    <base-application-logo class="w-20 h-20 fill-current text-gray-500"></base-application-logo>
                </router-link>
            </template>

            <!-- Session Status -->
            <base-auth-session-status v-if="status !== null" class="mb-4" :status="status"></base-auth-session-status>

            <!-- Validation Errors -->
            <base-auth-validation-errors v-if="Object.keys(form.errors.errors).length > 0" class="mb-4" :errors="form.errors.errors"></base-auth-validation-errors>

            <!-- Email Address -->
            <div>
                <base-label for="email" value="Email" />

                <base-input v-model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <base-label for="password" value="Password" />

                <base-input v-model="form.password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <router-link v-if="$router.resolve({ name: 'password.request' }).matched.length > 0" :to="{ name: 'password.request' }" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </router-link>

                <base-button @click="login" class="ml-3">
                    Login
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
                password: null,
                remember: null,
            }, async form => {
                await Http.get('/sanctum/csrf-cookie');
                const response = await Http.post('/login', form);
                await this.$auth.dispatch('me');

                this.$router.push({ name: 'dashboard' });
            }),
        }
    },
    methods: {
        login() {
            this.form.submit().catch(error => {});
        },
    },
}
</script>
