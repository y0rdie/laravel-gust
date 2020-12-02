<template>
    <div class="min-h-screen bg-gray-100">
        <the-navigation></the-navigation>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
import TheNavigation from '@layouts/Navigation';

export default {
    components: {
        TheNavigation,
    },
}
</script>
