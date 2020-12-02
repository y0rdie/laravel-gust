<template>
    <label class="block font-medium text-sm text-gray-700">
        <slot>{{ value }}</slot>
    </label>
</template>

<script>
export default {
    props: {
        value: String,
    },
}
</script>
