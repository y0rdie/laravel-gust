<template>
    <div>
        <div class="font-medium text-red-600">Whoops! Something went wrong.</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li
                v-for="(error, i) in errors"
                :key="i"
                v-text="error[0]"
            ></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        errors: Object,
    },
}
</script>
