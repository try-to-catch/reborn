<template>
        <section class="bg-gray-50 dark:bg-main-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
                <router-link :to="{ name: 'home'}" class="flex items-center mb-6 text-2xl font-semibold text-white">
                    <LogoIcon></LogoIcon>
                    Reborn
                </router-link>
                <div
                    class="w-full rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-main-500 border-main-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                            {{ title }}
                        </h1>
                        <slot/>
                    </div>
                </div>
            </div>
        </section>
</template>

<script>
import LogoIcon from "@/components/Icons/LogoIcon.vue";

export default {
    name: "AuthLayout",
    components: {LogoIcon},
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
