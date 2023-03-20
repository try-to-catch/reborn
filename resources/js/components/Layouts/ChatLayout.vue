<template>
    <div v-if="!isPageLoading" class="bg-main-900 text-white flex flex-col h-screen">
        <header class="basis-[36px] flex content-end">
            <div class="text-lg mt-1.5 ml-2.5">reborn</div>
        </header>
        <main class="flex bg-main-900 grow">
            <div class="bg-main-900 basis-[75px]"></div>
            <div class="bg-main-700 2xl:basis-[315px] basis-[265px] rounded-tl-2xl flex flex-col z-10">
                <div class="grow flex flex-col items-center mt-6">
                    <div class="w-full px-5">
                        <input type="text"
                               class="bg-main-500 w-full h-8 rounded-[5px] px-2 focus:outline focus:outline-2 focus:outline-slate-600"
                               placeholder="Search">
                    </div>
                    <div class="pt-8 flex justify-between w-full px-5 items-center cursor-pointer">
                        <div>
                            <font-awesome-icon icon="fa-solid fa-user-group" class="mr-3"/>
                            Friends
                        </div>
                    </div>
                    <div class="pt-8 flex justify-between w-full px-5 items-center text-sm">
                        <div>PRIVATE MESSAGES</div>
                        <div class="text-2xl hover:cursor-pointer">+</div>
                    </div>
                    <div class="w-full px-5 pt-5 flex flex-col space-y-4">
                        <div
                            class="w-full relative flex items-center after:hidden hover:after:block hover:after:content-['✕'] after:absolute after:top-1 after:right-1 after:text-gray-200 after:cursor-pointer">

                            <div class="bg-white w-8 h-8 rounded-full bg-gray-200"></div>
                            <div class="ml-4 text-gray-200 font-medium">Schaste</div>
                        </div>
                        <div
                            class="w-full relative flex items-center after:hidden hover:after:block hover:after:content-['✕'] after:absolute after:top-1 after:right-1 after:text-gray-200 after:cursor-pointer">

                            <div class="bg-white w-8 h-8 rounded-full bg-gray-200"></div>
                            <div class="ml-4 text-gray-200 font-medium">Rage</div>
                        </div>
                    </div>
                </div>
                <div class="basis-[55px] bg-main-800"></div>
            </div>
            <div class="bg-main-500 grow flex flex-col relative">
                <slot name="middleSection"/>
            </div>
            <div class="bg-main-700 2xl:basis-[315px] basis-[265px] hidden xl:flex xl:flex-col px-5 z-10">
                <slot name="rightSection"/>
            </div>
        </main>
    </div>
    <div v-else class="bg-gray-50 dark:bg-main-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
            <div class="flex items-center mb-6 text-2xl font-semibold text-white">
                <LogoIcon></LogoIcon>
                <span class="ml-2">
                    Reborn
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import LogoIcon from "@/components/Icons/LogoIcon.vue";

export default {
    name: "ChatLayout",
    components: {LogoIcon},
    props: {
        isPageLoading: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>

</style>
