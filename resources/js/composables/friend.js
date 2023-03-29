import {ref} from "vue";

export default function useFriend() {

    const searchData = ref([])

    async function friendSearch(username) {
        console.log({username})
        return await axios.post('/api/users/search', {username}).then(r => {
            console.log(r)
            searchData.value = [...r.data.data]
        }).catch((e) => {
            console.log(e)
        })
    }

    async function sendChatRequest(userId){
        return await axios.post('/api/chats/chat-request', {id: userId}).then(r => {
            console.log(r)
        })
    }

    return {friendSearch, searchData, sendChatRequest}
}
