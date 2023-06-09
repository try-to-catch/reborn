<template>
    <div v-if="!isLoading" class="bg-main-900 text-white flex flex-col h-screen">
        <header class="basis-[36px] flex content-end">
            <div class="text-lg mt-1.5 ml-2.5">reborn</div>
        </header>
        <main class="flex bg-main-900 grow">
            <div class="bg-main-900 basis-[75px]"></div>
            <div class="bg-main-700 2xl:basis-[315px] basis-[265px] rounded-tl-2xl flex flex-col z-10">
                <div class="grow flex flex-col items-center pt-6 text-main-text">
                    <SearchField v-model="searcher" class="px-2 pb-4"></SearchField>
                    <div
                        class="w-full px-2 py-2">
                        <router-link :to="{name: 'chats.index'}"
                                     :class="{
                                        'bg-main-300 text-gray-100': routeId === 0
                                      }"
                                     class="block px-3 w-full py-2 hover:bg-main-500 rounded hover:text-gray-200">
                            <font-awesome-icon :icon="['fas', 'user-group']" class="mr-4"/>
                            Friends
                        </router-link>

                    </div>
                    <div class="pt-4 flex justify-between w-full px-5 items-center text-sm">
                        <div>PRIVATE MESSAGES</div>
                        <router-link :to="{name: 'chats.index', query: {section:'add_friend'}}"
                                     class="text-2xl hover:cursor-pointer text-gray-200">
                            +
                        </router-link>
                    </div>
                    <div class="w-full px-2 pt-5 flex flex-col space-y-0.5" id="chats-block">
                        <router-link v-for="chat in  filteredChats" :key="chat.id"
                                     :to="{name: 'chats.show', params:{id:chat.id}}"
                                     @mouseover="showCross(chat.id)"
                                     @mouseleave="hideCross"
                                     class="w-full relative py-2 px-3 flex items-center hover:bg-main-500 rounded hover:text-gray-200">

                            <div class="w-8 h-8 rounded-full bg-gray-200"><img class="scale-105"
                                                                               :src="chat.friend.thumbnail"
                                                                               alt="friend_icon"></div>
                            <div class="ml-4  font-medium">{{ chat.friend.name }}</div>
                            <div v-show="activeCross === chat.id" @click.prevent="deleteChat(chat.id)" role="button"
                                 class="hover:rounded-md absolute top-3 right-3.5">✕
                            </div>
                        </router-link>
                    </div>
                </div>
                <div v-if="!isLoading && user.thumbnail"
                     class="basis-[55px] bg-main-800 flex justify-between items-center px-5">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gray-200"><img class="scale-105"
                                                                           :src="user.thumbnail"
                                                                           alt="friend_icon"></div>
                        <div class="ml-4 text-gray-100 font-medium">{{ user.username }}</div>
                    </div>
                    <button type="button">
                        <font-awesome-icon :icon="['fas', 'gear']"/>
                    </button>
                </div>
            </div>
            <div class="flex grow">
                <router-view :user="user"></router-view>
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

<script setup>
import LogoIcon from "@/components/Icons/LogoIcon.vue";
import useUser from "@/composables/user";
import useChat from "@/composables/chat";
import {computed, onBeforeMount, ref, watchEffect} from "vue";
import SearchField from "@/components/Form/SearchField.vue";

const {user, isLoading: isUserLoading} = useUser()
const {chats, setChats, isLoading: isChatLoading, deleteChat} = useChat()
const activeCross = ref(0)


onBeforeMount(() => {
    if (!chats.length) {
        setChats()
    }
})

const props = defineProps({
    routeId: {type: Number, required: true}
})

function showCross(id) {
    activeCross.value = id
}

function hideCross() {
    activeCross.value = 0
}


const isLoading = computed(() => {
    return isChatLoading.value && isUserLoading.value && chats.length && Object.keys(user)
})


const searcher = ref('')
const filteredChats = ref([])

watchEffect(() => {
    if (chats.value) {
        filteredChats.value = chats.value.filter((item) => {
            return item.friend.username.includes(searcher.value)
        })
    }
})

</script>


<style>
#chats-block .router-link-active {
    @apply bg-main-300 text-gray-100;
}
</style>
