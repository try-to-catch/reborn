<template>
    <div class="flex grow flex-col-reverse mt-[60px]">
        <ul ref="scrollContainer"
            class="chat-block space-y-6 overflow-auto px-2 2xl:px-4">

            <MessageGroup v-for="messageGroup in preparedChat" :key="messageGroup.id" :messages="messageGroup"
                          :user="props.user" :friend="props.chat.friend"></MessageGroup>
            <li v-if="pendingMessages?.length"
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
</template>

<script setup>

import {computed, nextTick, ref, watch, watchEffect} from "vue";
import MessageGroup from "@/components/Chat/Message/MessageGroup.vue";

const props = defineProps({
    chat: {
        type: Object,
        required: true
    },
    user: {
        type: Object,
        required: true
    },
    pendingMessages: {
        type: Array,
    }
})

const lastMessage = computed(() => {
    return props.chat.messages[props.chat.messages.length - 1]
})

const preparedChat = computed(() => {
    if (!props.chat.messages) {
        return []
    }
    const messages = []

    props.chat.messages.map((val, id) => {
        if (id === 0 || val.user_id !== props.chat.messages[id - 1].user_id) {
            messages.push({sent_at: val.sent_at, user_id: val.user_id, messageList: [{...val}]})
        } else {
            messages[messages.length - 1].messageList.push(val)
        }

        return val
    })

    return messages || [];
})

const scrollContainer = ref(null);

watch(props.chat, async () => {
    if (props.chat && Boolean(scrollContainer.value)) {
        await nextTick()
        updateScrollHeight()
    }
})

watchEffect(() => {
    if (scrollContainer.value) {
        updateScrollHeight()
    }
})

function updateScrollHeight() {
    scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight - scrollContainer.value.clientHeight;
}


</script>

<style lang="scss" scoped>
.chat-block {
    max-height: calc(100vh - 170px);

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
