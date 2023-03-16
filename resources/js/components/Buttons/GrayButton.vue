<template>
    <button
        :disabled="isDisabled"
            type="submit"
            class="w-full text-white disabled:bg-main-700 bg-main-800 hover:bg-main-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:disabled:bg-main-700  dark:bg-zink-900 dark:hover:bg-main-900 dark:focus:ring-main-800 ease-in duration-300">
        <slot/>
    </button>
</template>

<script>
export default {
    name: "GrayButton",
    props: {
        isDisabled: {
            type: Boolean,
            required: false,
            default: false
        }
    },

}
</script>
