import {reactive, ref} from "vue";

export default function useFriend() {
    const isLoading = ref(false)
    const searchData = ref([])

    function withLoading(fn) {
        return async (...args) => {
            isLoading.value = true
            try {
                return await fn(...args)
            } finally {
                isLoading.value = false
            }
        }
    }


    const friendSearch = withLoading(async function (username) {
        return await axios.post('/api/users/search', {username}).then((res) => {
            return searchData.value = [...res.data.data]
        })
    })


    const sentRequests = reactive([])

    const sendChatRequest = async function (userId) {
        sentRequests.push(userId)

        return await axios.post('/api/chats/chat-requests', {id: userId})
    }


    const chatRequests = ref([])

    const getChatRequests = withLoading(async function () {
        return await axios.get('/api/chats/chat-requests').then(res => {
            return chatRequests.value.push(...res.data.data)
        })
    })

    const considerRequest = async function (requestId, sender_id, is_accept) {
        chatRequests.value = chatRequests.value.filter((request) => {
            return request.id !== requestId
        })

        return await axios.patch(`/api/chats/chat-requests/${requestId}`, {sender_id, is_accept})
    }

    return {
        friendSearch,
        searchData,
        sendChatRequest,
        getChatRequests,
        isLoading,
        chatRequests,
        considerRequest,
        sentRequests
    }
}
