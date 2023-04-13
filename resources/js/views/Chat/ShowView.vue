<template>
    <div class="bg-main-500 grow flex flex-col relative">
        <loading v-if="isLoading" v-model:active="isLoading" :is-full-page="false" background-color="#2C2F33"
                 :opacity="1"
                 color="#d1d5db"></loading>

        <template v-else>
            <div
                class="chat-block-header border-b border-main-900 h-14 absolute inset-x-0 top-0 bg-main-500 flex items-center px-3">
                <font-awesome-icon :icon="['fas', 'at']" class=" text-gray-400 font-light text-xl"/>
                <span class="ml-2">{{ preparedUsername }}</span>
            </div>
            <div class="px-2 relative h-full flex flex-col">

                <ChatBlock :user="user" :chat="chat" :pendingMessages="pendingMessages"></ChatBlock>
                <form @submit.prevent="sendMessage" class="basis-10 py-5 w-full flex px-2 2xl:px-4">
                    <textarea @keydown.enter.prevent="sendMessage" v-model="newMessage" tabindex="0"
                              class="w-full h-auto bg-main-300 rounded-[5px] outline-none text-sm px-3 min-h-[36px] max-h-[200px] pt-2 resize-none border-0 focus:ring-0 focus-visible:ring-0 overflow-y-hidden"
                              rows="1" placeholder="Send message..."></textarea>
                    <button
                        type="submit"
                        class=" ml-2 bg-main-700 rounded-[5px] h-[36px] px-8 flex items-center text-gray-200 font-medium 2xl:hidden">
                        Send
                    </button>
                </form>
            </div>
        </template>
    </div>


    <div class="bg-main-700 2xl:basis-[315px] basis-[265px] hidden xl:flex xl:flex-col px-5 z-10 relative">

        <template v-if="!isLoading && chat.friend">
            <div class="w-24 h-24 rounded-full bg-gray-200 mt-10">
                <img :src="chat.friend.thumbnail" alt="friend_icon">
            </div>
            <div class="mt-4 bg-main-800 w-full rounded-[5px] p-3">
                <div class="border-b pb-1 border-main-700">
                    <div class="text-xl font-medium">{{ chat.friend.name }}</div>
                    <div class="text-xs text-gray-300">{{ chat.friend.username }}</div>
                </div>
                <div v-if="chat.friend.bio" class="pt-2.5">
                    <div class="text-sm font-medium">ABOUT</div>
                    <div class="text-xs text-gray-300">{{ chat.friend.bio }}</div>
                </div>
                <div class="pt-2.5">
                    <div class="text-sm font-medium">REBORN MEMBER SINCE</div>
                    <div class="text-xs text-gray-300">{{ chat.friend.joined_at }}</div>
                </div>
            </div>
        </template>

    </div>

</template>

<script setup>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import useChat from "@/composables/chat";
import {computed, onBeforeMount, ref} from "vue";
import ChatBlock from "@/components/Chat/ChatBlock.vue";


const {chat, setChat, isLoading, createMessage, pendingMessages} = useChat()

onBeforeMount(setChat)

const props = defineProps({
    user: {type: Object, required: true}
})
const preparedUsername = computed(() => {
    return chat.friend?.username.slice(1) || '';
})

const newMessage = ref('')

function sendMessage() {
    if (newMessage.value.length) {
        createMessage(newMessage.value)

        newMessage.value = ''
    }
}

</script>
