<template>
    <div v-text="status" class="font-medium text-sm text-green-600"></div>
</template>

<script>
export default {
    props: {
        status: String,
    },
}
</script>
