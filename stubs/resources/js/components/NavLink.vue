<template>
    <router-link
        :to="{ name: routeName }"
        :class="active
            ? 'border-indigo-400 text-gray-900 focus:border-indigo-700'
            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:border-gray-300'"
        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out"
    >
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    props: {
        routeName: String,
        active: Boolean,
    },
}
</script>
