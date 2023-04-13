<template>
    <div class="bg-main-500 grow flex flex-col relative">
        <div class="px-2 relative h-full flex flex-col">
            <nav class="h-12 w-full border-b border-main-800">
                <ul class="w-hull h-full flex space-x-4 items-center text-gray-300">
                    <li @click="openMessageRequestsSection"
                        :class="{'bg-main-300 rounded-md': activeSection === MESSAGE_REQUESTS}"
                        class="cursor-pointer px-2 py-1">Message requests
                    </li>
                    <li @click="openAddFriendSection"
                        :class="{'bg-main-300 rounded-md': activeSection === ADD_FRIEND}"
                        class="cursor-pointer px-2 py-1 ">Add friend
                    </li>
                </ul>
            </nav>

            <div v-if="activeSection === MESSAGE_REQUESTS" class="text-gray-100 text-center h-full">
                <div v-if="isLoading" class="w-full h-full items-center flex justify-center">
                    <loading v-model:active="isLoading" background-color="#2C2F33" :is-full-page="false"
                             :opacity="1"
                             color="#d1d5db"></loading>
                </div>

                <template v-else>
                    <div v-if="!chatRequests.length" class="pt-10">
                        There is no pending message requests.
                    </div>

                    <ul v-else class="w-full px-2 pt-5 flex flex-col space-y-0.5">
                        <li v-for="chatRequest in  chatRequests" :key="chatRequest.id"
                            @mouseover="setFocusedUser(chatRequest.sender.id)"
                            @mouseleave="unsetFocusedUser"
                            class="w-full py-2 px-3 flex justify-between items-center text-gray-300 hover:bg-main-300 rounded ease-in  duration-100 hover:text-gray-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200"><img class="scale-105"
                                                                                            :src="chatRequest.sender.thumbnail"
                                                                                            alt="avatar"></div>
                                <div class="ml-4 font-medium">
                                    {{ chatRequest.sender.name }}
                                    <span class="text-xs text-gray-500">{{ chatRequest.sender.username }}</span>
                                </div>
                            </div>
                            <div v-show="focusedUser === chatRequest.sender.id" class="text-lg">
                                <font-awesome-icon
                                    @click.once="considerRequest(chatRequest.id, chatRequest.sender.id, true)"
                                    :icon="['fas', 'check']"
                                    class="cursor-pointer ease-in duration-300 hover:text-green-400 mr-4"/>
                                <font-awesome-icon
                                    @click.once="considerRequest(chatRequest.id, chatRequest.sender.id, false)"
                                    :icon="['fas', 'xmark']"
                                    class="cursor-pointer ease-in duration-300 hover:text-red-400"/>
                            </div>
                        </li>
                    </ul>
                </template>
            </div>

            <div v-else-if="activeSection === ADD_FRIEND" class="pt-4 h-full">
                <SearchField v-model="searchingString" @keyup.enter="friendSearch(searchingString)"
                             :classes="['bg-main-700 text-gray-300 h-[40px]']"
                             :iconClasses="['top-3.5 right-4']"
                             :placeholder="'Input your friend username to find him'"></SearchField>

                <div v-if="isLoading" class="w-full h-[150px] items-center flex justify-center">
                    <loading v-model:active="isLoading" :height="50" :is-full-page="false" background-color="#2C2F33"
                             :opacity="1"
                             color="#d1d5db"></loading>
                </div>

                <template v-else>
                    <ul v-if="searchData.length" class="w-full px-2 pt-5 flex flex-col space-y-0.5">
                        <li v-for="user in  searchData" :key="user.id"
                            @mouseover="setFocusedUser(user.id)"
                            @mouseleave="unsetFocusedUser"
                            class="w-full py-2 px-3 flex justify-between items-center text-gray-300 hover:bg-main-300 ease-in duration-100 rounded hover:text-gray-200">
                            <div class="flex items-center">
                                <div class="bg-white w-8 h-8 rounded-full bg-gray-200"><img class="scale-105"
                                                                                            :src="user.thumbnail"
                                                                                            alt="avatar"></div>
                                <div class="ml-4 font-medium">
                                    {{ user.name }}
                                    <span class="text-xs text-gray-500">{{ user.username }}</span>
                                </div>
                            </div>
                            <div v-show="focusedUser === user.id">
                                <div v-if="!sentRequests.includes(user.id)" @click="sendChatRequest(user.id)"
                                     class="cursor-pointer px-3 py-1 bg-main-500 rounded-md text-sm text-gray-300">
                                    Send request
                                </div>
                                <div v-else>
                                    <font-awesome-icon :icon="['fas', 'square-check']"
                                                       class="text-2xl text-gray-200"/>
                                </div>
                            </div>
                        </li>
                    </ul>
                </template>
            </div>

        </div>
    </div>

    <div class="bg-main-700 2xl:basis-[315px] basis-[265px] hidden xl:flex xl:flex-col px-5 z-10">
        <div class="mt-10 text-2xl font-bold text-gray-200">
            Friends Activity:
        </div>
        <div class="mt-4 bg-main-800 w-full rounded-[5px] p-3 ">
            <div class="text-gray-300 text-sm">There are currently no friends online</div>
            <div class="text-gray-400 text-xs">probably they are sleeping</div>
        </div>
    </div>


</template>

<script setup>
import Loading from 'vue-loading-overlay';
import SearchField from "@/components/Form/SearchField.vue";
import {onBeforeMount, ref} from "vue";
import useFriend from "@/composables/friend";
import {useRoute, useRouter} from "vue-router";

const route = useRoute()
const router = useRouter()
const {
    friendSearch,
    searchData,
    sendChatRequest,
    getChatRequests,
    chatRequests,
    considerRequest,
    sentRequests,
    isLoading
} = useFriend()

const props = defineProps({
    user: {type: Object, required: false}
})

const MESSAGE_REQUESTS = 1
const ADD_FRIEND = 2

const searchingString = ref('')

onBeforeMount(() => {
    if (route.query.section === 'add_friend') {
        activeSection.value = ADD_FRIEND
    } else {
        getChatRequests()
    }
})


const activeSection = ref(MESSAGE_REQUESTS)

function openAddFriendSection() {
    activeSection.value = ADD_FRIEND
    router.push({path: route.path, query: {section: 'add_friend'}});
}

function openMessageRequestsSection() {
    activeSection.value = MESSAGE_REQUESTS
    router.push({path: route.path, query: {section: 'message_request'}});
}


const focusedUser = ref(0)

function setFocusedUser(id) {
    focusedUser.value = id
}

function unsetFocusedUser() {
    focusedUser.value = 0
}
</script>
