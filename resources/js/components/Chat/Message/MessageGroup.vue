<template>
    <li class="flex">
        <div class="bg-white w-[44px] h-[44px] rounded-full bg-gray-200">
            <img v-if="messages.user_id===user.id" :src="user.thumbnail" alt="user_icon">
            <img v-else-if="!!friend?.thumbnail" :src="friend.thumbnail" alt="user_icon">
        </div>
        <div class="ml-2">
            <div class="text-md">
                <template v-if="messages.user_id===user.id">{{ user.name }}</template>
                <template v-else>{{ friend.name }}</template>
                <span class="ml-2 text-zinc-500" style="font-size: 11px">
                    {{ messages.sent_at }}
                </span>
            </div>
            <div v-for="messageItem in messages.messageList" :key="messageItem.id"
                 class="text-sm text-gray-300 space-y-2">
                {{ messageItem.text }}
            </div>
        </div>
    </li>
</template>

<script setup>

const props = defineProps({
    messages: {
        type: Object,
        required: true
    },
    user: {
        type: Object,
        required: true
    },
    friend: {
        type: Object,
        required: true
    },
})

</script>

<style scoped>

</style>
