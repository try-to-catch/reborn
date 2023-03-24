import {onMounted, reactive, ref} from "vue";
import axios from "axios";
import {onBeforeRouteUpdate, useRoute} from "vue-router";

export default function useChat() {
    const route = useRoute()

    const isLoading = ref(false)
    const chat = reactive({})

    onMounted(setChat)


    onBeforeRouteUpdate(async (to, from) => {
        if (to.params.id !== from.params.id) {
            await setChat()
        }
    })


    async function getChat(chatId) {
        return axios.post(`/api/chats/${chatId}`).then(res => res.data.data)
    }


    async function setChat() {
        isLoading.value = true;

        await getChat(route.params.id).then(res => {
            Object.assign(chat, res);
        })

        isLoading.value = false
    }

    return {isLoading, chat}
}
