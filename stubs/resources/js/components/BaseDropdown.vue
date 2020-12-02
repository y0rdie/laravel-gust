<template>
    <div class="relative">
        <div @click="open = ! open">
            <slot name="trigger"></slot>
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                @click="open = false"
                :class="[alignmentClasses, widthClass]"
                class="absolute z-50 mt-2 rounded-md shadow-lg"
            >
                <div :class="contentClasses" class="rounded-md ring-1 ring-black ring-opacity-5">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        align: String,
        width: String,
        contentClasses: String,
    },
    computed: {
        alignmentClasses() {
            switch (this.align) {
                case 'left':
                    return 'origin-top-left left-0';
                    break;
                case 'top':
                    return 'origin-top';
                    break;
                case 'right':
                default:
                    return 'origin-top-right right-0';
                    break;
            }
        },
        widthClass() {
            switch (this.width) {
                case '48':
                    return 'w-48';
                    break;
            }
        },
    },
    data() {
        return {
            open: false,
        }
    },
}
</script>
