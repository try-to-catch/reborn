<template>
    <ChatLayout>
        <template v-if="!isLoading" #middleSection="{user}">
            <div
                class="chat-block-header border-b border-main-900 h-14 absolute inset-x-0 top-0 bg-main-500 flex items-center px-3">
                <font-awesome-icon :icon="['fas', 'at']" class=" text-gray-400 font-light text-xl"/>
                <span class="ml-2">{{ preparedUsername }}</span>
            </div>
            <div class="px-2 relative h-full flex flex-col">
                <div class="flex grow flex-col-reverse mt-[60px]">
                    <ul ref="scrollContainer"
                        class="chat-block space-y-6 overflow-auto px-2 2xl:px-4">

                        <li v-for="messageGroup in preparedChat" :key="messageGroup.id" class="flex">
                            <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200">
                                <img v-if="messageGroup.user_id===user.id" :src="user.thumbnail" alt="user_icon">
                                <img v-else :src="chat.friend.thumbnail" alt="user_icon">
                            </div>
                            <div class="ml-2">
                                <div
                                    class="text-md">
                                    <template v-if="messageGroup.user_id===user.id">{{ user.name }}</template>
                                    <template v-else>{{ chat.friend.name }}</template>
                                    <span class="ml-2 text-zinc-500" style="font-size: 11px">{{
                                            messageGroup.sent_at
                                        }}</span>
                                </div>
                                <div v-for="messageItem in messageGroup.messageList" :key="messageItem.id"
                                     class="text-sm text-gray-300 space-y-2">
                                    {{ messageItem.text }}
                                </div>
                            </div>
                        </li>
                        <li v-if="pendingMessages.length"
                            :style="{'margin-top':lastMessage.user_id===user.id?'0':'24px'} " class="flex">
                            <div :class="{ invisible: lastMessage.user_id===user.id }"
                                 class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200">
                                <img :src="user.thumbnail" alt="user_icon">
                            </div>
                            <div class="ml-2">
                                <div v-show="lastMessage.user_id!==user.id" class="text-md">
                                    {{ user.name }}

                                    <span class="ml-2 text-zinc-500" style="font-size: 11px">just now</span>
                                </div>
                                <div v-for="text in pendingMessages"
                                     class="text-sm text-gray-400 space-y-2">
                                    {{ text }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <form @submit.prevent="sendMessage" class="basis-10 py-5 w-full flex px-2 2xl:px-4">
                    <textarea @keydown.enter.prevent="sendMessage" v-model="newMessage" tabindex="0"
                              class="w-full h-auto bg-main-300 rounded-[5px] outline-none px-3 min-h-[36px] max-h-[200px] pt-1.5 resize-none border-0 focus:ring-0 focus-visible:ring-0 overflow-y-hidden"
                              rows="1"></textarea>
                    <button
                        type="submit"
                        class=" ml-2 bg-main-700 rounded-[5px] h-[36px] px-8 flex items-center text-gray-200 font-medium 2xl:hidden">
                        Send
                    </button>
                </form>
            </div>
        </template>

        <template v-else #middleSection class="w-full h-full flex items-center justify-center">
            <loading v-model:active="isLoading" :is-full-page="false" background-color="#2C2F33" :opacity="1"
                     color="#d1d5db"></loading>
        </template>

        <template v-if="chat.friend && !isLoading" #rightSection>
            <div class="bg-white w-24 h-24 rounded-full bg-gray-200 mt-10">
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
    </ChatLayout>

</template>

<script setup>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import ChatLayout from "@/components/Layouts/ChatLayout.vue";
import useChat from "@/composables/chat";
import {computed, nextTick, ref, watch, watchEffect} from "vue";


const {chat, isLoading, createMessage, pendingMessages} = useChat()

const preparedUsername = computed(() => {
    return chat.friend?.username.slice(1) || '';
})

const preparedChat = computed(() => {
    if (!chat.messages) {
        return []
    }
    const messages = []

    chat.messages.map((val, id) => {
        if (id === 0 || val.user_id !== chat.messages[id - 1].user_id) {
            messages.push({sent_at: val.sent_at, user_id: val.user_id, messageList: [{...val}]})
        } else {
            messages[messages.length - 1].messageList.push(val)
        }

        return val
    })

    return messages || [];
})

const newMessage = ref('')
function sendMessage() {
    if (newMessage.value.length) {
        createMessage(newMessage.value)

        newMessage.value = ''
    }
}

const lastMessage = computed(() => {
    return chat.messages[chat.messages.length - 1]
})


const scrollContainer = ref(null);

watch(preparedChat, async()=>{
    if (preparedChat && Boolean(scrollContainer.value)){
        await nextTick()
        updateScrollHeight()
    }
})

watchEffect(() => {
    if (scrollContainer.value) {
        updateScrollHeight()
    }
})

function updateScrollHeight(){
    scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight - scrollContainer.value.clientHeight;
}

</script>
