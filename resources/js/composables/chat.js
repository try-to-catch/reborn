import {reactive, ref, watchEffect} from "vue";
import axios from "axios";
import {onBeforeRouteUpdate, useRoute} from "vue-router";

export default function useChat() {
    const route = useRoute()

    const isLoading = ref(false)
    onBeforeRouteUpdate(async (to, from) => {
        if (to.params.id !== from.params.id) {
            await setChat(to.params.id)
        }
    })

    const chats = ref([])

    async function getChats() {
        return await axios.get('/api/chats').then(res => res.data.data)
    }

    async function setChats() {
        isLoading.value = true

        await getChats().then(res => {
            chats.value.push(...res)
        })

        isLoading.value = false
    }


    const chat = reactive({})

    async function getChat(chatId) {
        return axios.get(`/api/chats/${chatId}`).then(res => res.data.data)
    }


    async function setChat(chatId = route.params.id) {
        isLoading.value = true

        await getChat(chatId).then(res => {
            Object.assign(chat, res)
        })

        isLoading.value = false
    }


    const pendingMessages = ref([])

    async function createMessage(text) {
        pendingMessages.value.push(text)
        await axios.post(`/api/messages/${chat.id}`, {text}).then((res) => {
            const deliveredMessage = res.data.data

            pendingMessages.value = pendingMessages.value.filter((message) => {
                return message !== deliveredMessage.text
            })
        })
    }


    async function deleteChat(chatId) {
        return await axios.delete(`/api/chats/${chatId}`).then(() => {
            chats.value = chats.value.filter((item) => {
                return item.id !== chatId
            })
        })
    }


    const isAuthenticated = localStorage.getItem('x_xsrf_token')

    watchEffect(() => {
        if (chat.id && isAuthenticated) {
            Echo.private(`chats.${chat.id}`)
                .listen('MessageSent', (e) => {
                    chat.messages.push(e.message)
                })
        }
    })
    return {isLoading, chat, setChat, createMessage, pendingMessages, chats, setChats, deleteChat}
}
