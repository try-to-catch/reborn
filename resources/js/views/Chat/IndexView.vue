<template>
    <ChatLayout>
        <template #middleSection>
            <div class=" chat-block-header border-b border-main-900 h-14 absolute inset-x-0 top-0 bg-main-500">
                his
            </div>
            <div class="px-2 relative h-full flex flex-col">
                <ul
                    class="chat-block flex grow flex-col-reverse space-y-2 space-y-reverse overflow-auto px-2 2xl:px-4 mt-[80px]">
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>
                    <li class="flex">
                        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200"></div>
                        <div class="ml-2">
                            <div class="text-md">Schaste</div>
                            <div class="text-sm">Погнали, сколько можно</div>
                        </div>
                    </li>

                </ul>
                <div class="basis-10 py-5 w-full flex px-2 2xl:px-4 ">
            <textarea tabindex="0" class="w-full h-auto bg-main-300 rounded-[5px] outline-none px-3 h-[36px] max-h-[200px] pt-1.5 resize-none border-0 focus:ring-0 focus-visible:ring-0 overflow-y-hidden
            " rows="1"></textarea>
                    <div
                        class=" ml-2 bg-main-700 rounded-[5px] h-[36px] px-8 flex items-center text-gray-200 font-medium 2xl:hidden">
                        Send
                    </div>
                </div>
            </div>
        </template>

        <template #rightSection>
            <div class="bg-white w-24 h-24 rounded-full bg-gray-200 mt-10"></div>
            <div class="mt-4 bg-main-800 w-full rounded-[5px] p-3">
                <div class="border-b pb-1 border-main-700">
                    <div class="text-xl">Meat enjoyer</div>
                    <div class="text-xs">@steave_12312</div>
                </div>
                <div class="pt-2.5">
                    <div class="text-sm font-semibold">ABOUT</div>
                    <div class="text-xs">Just boy who adore drink so wine time at time</div>
                </div>
                <div class="pt-2.5">
                    <div class="text-sm font-semibold">JOINED AT</div>
                    <div class="text-xs">february 15, 2003</div>
                </div>
            </div>
        </template>
    </ChatLayout>

</template>

<script setup>
import ChatLayout from "@/components/Layouts/ChatLayout.vue";
</script>

