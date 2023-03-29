<template>
    <ChatLayout>
        <template #middleSection>
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
                <div v-if="activeSection === MESSAGE_REQUESTS" class="pt-10 text-gray-100 text-center">
                    There is no pending message requests.
                </div>
                <div v-else-if="activeSection === ADD_FRIEND" class="pt-4">
                    <SearchField v-model="searchingString" @keyup.enter="search"
                                 :classes="['bg-main-700 text-gray-300 h-10']"
                                 :iconClasses="['top-3.5 right-4']"
                                 :placeholder="'Input your friend username to find him'"></SearchField>
                    <div v-if="searchData.length" class="w-full px-2 pt-5 flex flex-col space-y-0.5">
                        <div v-for="user in  formattedSearchingData" :key="user.id"
                             @mouseover="showAddButton(user.id)"
                             @mouseleave="hideAddButton"
                             class="w-full py-2 px-3 flex justify-between items-center text-gray-300 hover:bg-main-300 rounded hover:text-gray-200">
                            <div class="flex items-center">
                                <div class="bg-white w-8 h-8 rounded-full bg-gray-200"><img class="scale-105"
                                                                                            :src="user.thumbnail"
                                                                                            alt="friend_icon"></div>
                                <div class="ml-4 font-medium">{{ user.username }}</div>
                            </div>
                            <div v-show="focusedUser === user.id">
                                <div v-if="!sentRequests.includes(user.id)" @click="sendRequest(user.id)"
                                     class="cursor-pointer px-3 py-1 bg-main-500 rounded-md text-sm text-gray-300">
                                    Send request
                                </div>
                                <div v-else><font-awesome-icon :icon="['fas', 'square-check']" class="text-2xl text-gray-200"/></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </template>

        <template #rightSection>
            <div class="mt-10 text-2xl font-bold text-gray-200">
                Friends Activity:
            </div>
            <div class="mt-4 bg-main-800 w-full rounded-[5px] p-3 ">
                <div class="text-gray-300 text-sm">There are currently no friends online</div>
                <div class="text-gray-400 text-xs">probably they are sleeping</div>
            </div>
        </template>
    </ChatLayout>

</template>

<script setup>
import ChatLayout from "@/components/Layouts/ChatLayout.vue";
import SearchField from "@/components/Form/SearchField.vue";
import {computed, reactive, ref} from "vue";
import useFriend from "@/composables/friend";

const {friendSearch, searchData, sendChatRequest} = useFriend()

const MESSAGE_REQUESTS = 1
const ADD_FRIEND = 2

const activeSection = ref(MESSAGE_REQUESTS)

function openAddFriendSection() {
    activeSection.value = ADD_FRIEND
}

function openMessageRequestsSection() {
    activeSection.value = MESSAGE_REQUESTS
}

const searchingString = ref('')

function search() {
    friendSearch(searchingString.value)
}

const formattedSearchingData = computed(() => {
    return searchData.value.map(user => {
        user.username = user.username.slice(1)

        return user
    })
})
const focusedUser = ref(0)

function showAddButton(id) {
    focusedUser.value = id
}

function hideAddButton() {
    focusedUser.value = 0
}

const sentRequests = reactive([])

function sendRequest(id) {
    sentRequests.push(id)

    sendChatRequest(id)
}
</script>

<style lang="scss" scoped>
.chat-block {
    max-height: calc(100vh - 98px);

    &::-webkit-scrollbar {
        width: 7px;
        background-color: #2b2d32;
        border-radius: 10px;
    }

    &::-webkit-scrollbar-thumb {
        background-color: #222427;
        border-radius: 10px;
    }
}

.chat-block-header {
    z-index: 1;
    box-shadow: 0 4px 0.3em rgba(0, 0, 0, 0.25);
}
</style>
