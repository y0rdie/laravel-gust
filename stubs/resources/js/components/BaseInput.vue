<template>
    <input
        @input="$emit('input', $event.target.value)"
        :value="value"
        :disabled="disabled"
        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
</template>

<script>
export default {
    props: {
        value: String,
        disabled: Boolean,
    },
}
</script>
