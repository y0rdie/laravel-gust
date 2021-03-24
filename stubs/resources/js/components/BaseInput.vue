<template>
    <input
        @input="$emit('update:modelValue', $event.target.value)"
        :value="modelValue"
        :disabled="disabled"
        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
</template>

<script>
export default {
    props: {
        modelValue: String,
        disabled: Boolean,
    },
    emits: [
        'update:modelValue',
    ],
}
</script>
