<template>
        <section class="bg-gray-50 dark:bg-main-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
                <a href="/public" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                         alt="logo">
                    Reborn
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-main-500 dark:border-main-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            {{ title }}
                        </h1>
                        <slot/>
                    </div>
                </div>
            </div>
        </section>
</template>

<script>
export default {
    name: "AuthLayout",
    props:{
        title: {
            type: String,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
