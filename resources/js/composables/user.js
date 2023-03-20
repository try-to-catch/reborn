import axios from "axios";
import {ref} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

export default function useUser() {
    const router = useRouter()

    const {getters, dispatch} = useStore()

    const errors = ref([{}])

    async function attempt(credentials) {
        await axios.get('/sanctum/csrf-cookie')
            .then(() => {
                axios.post('/login', credentials)
                    .then(response => {
                        authentication(response)
                    })
                    .catch(e => {
                        errors.value = e.response.data.errors
                    })
            })
    }


    async function create(credentials) {
        await axios.get('/sanctum/csrf-cookie')
            .then(() => {
                axios.post('/sign-up', credentials)
                    .then(response => {
                        authentication(response)
                    })
                    .catch(e => {
                        errors.value = e.response.data.errors
                    })
            })
    }

    function authentication(response) {
        setUser(response.data.data).then(() => {
            router.push({name: 'chats.index'})
        })

        localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])

    }


    async function getUser() {
        const user = getters['user/getUser']
        if (Object.keys(user ?? {}).length){
            return user
        }

        return await setUser()
    }

    async function setUser(user) {
        user = Object.keys(user ?? {}).length || await axios.post('/api/user').then(r => r.data.data)
        await dispatch('user/setUser', user)
        console.log(user)
        return user
    }


    return {errors, attempt, create, getUser}
}
