<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <router-link :to="{ name: 'dashboard' }" >
                            <base-application-logo class="block h-10 w-auto fill-current text-gray-600"></base-application-logo>
                        </router-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <nav-link route-name="dashboard" :active="this.$route.name === 'dashboard'">
                            Dashboard
                        </nav-link>

                        <nav-link route-name="settings" :active="this.$route.name === 'settings'">
                            Settings
                        </nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <base-dropdown align="right" width="48" content-classes="py-1 bg-white">
                        <template v-slot:trigger>
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div v-text="$auth.state.user.name"></div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </template>

                        <!-- Authentication -->
                        <base-dropdown-link route-name="logout">
                            Logout
                        </base-dropdown-link>
                    </base-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path v-if="open" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            <path v-else class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div v-if="open" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <responsive-nav-link route-name="dashboard" :active="this.$route.name === 'dashboard'">
                    Dashboard
                </responsive-nav-link>

                <responsive-nav-link route-name="settings" :active="this.$route.name === 'settings'">
                    Settings
                </responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div v-text="$auth.state.user.name" class="font-medium text-base text-gray-800"></div>
                        <div v-text="$auth.state.user.email" class="font-medium text-sm text-gray-500"></div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <responsive-nav-link route-name="logout">
                        Logout
                    </responsive-nav-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import NavLink from '@components/NavLink';
import ResponsiveNavLink from '@components/ResponsiveNavLink';

export default {
    components: {
        NavLink,
        ResponsiveNavLink,
    },
    data() {
        return {
            open: false,
        }
    },
}
</script>
