import {onMounted, reactive, ref} from "vue";
import axios from "axios";
import {onBeforeRouteUpdate, useRoute} from "vue-router";

export default function useChat() {
    const route = useRoute()

    const isLoading = ref(false)
    const pendingMessages = ref([])
    const chat = reactive({})

    onMounted(setChat)


    onBeforeRouteUpdate(async (to, from) => {
        if (to.params.id !== from.params.id) {
            await setChat(to.params.id)
        }
    })


    async function getChat(chatId) {
        return axios.get(`/api/chats/${chatId}`).then(res => res.data.data)
    }


    async function setChat(chatId = route.params.id) {
        isLoading.value = true;

        await getChat(chatId).then(res => {
            Object.assign(chat, res);
        })

        isLoading.value = false
    }


    async function createMessage(text) {
        pendingMessages.value.push(text)
        await axios.post(`/api/messages/${chat.id}`, {text}).then((res) => {
            const deliveredMessage = res.data.data

            chat.messages.push(deliveredMessage)

            pendingMessages.value = pendingMessages.value.filter((message) => {
                return message !== deliveredMessage.text
            })
        })
    }

    return {isLoading, chat, createMessage, pendingMessages}
}
