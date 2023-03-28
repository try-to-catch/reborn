import axios from "axios";
import {onMounted, reactive, ref} from "vue";
import {useRouter} from "vue-router";

export default function useUser() {
    const router = useRouter()

    const errors = ref([])

    const isLoading = ref(false)


    async function attempt(credentials) {
        await axios.get('/sanctum/csrf-cookie')
            .then(() => {
                axios.post('/login', credentials).then(handleFulfilled, handleReject)
            })
    }


    async function create(credentials) {
        await axios.get('/sanctum/csrf-cookie')
            .then(() => {
                axios.post('/sign-up', credentials).then(handleFulfilled, handleReject)
            })
    }

    function handleFulfilled(response) {
        localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])

        Object.assign(user, response.data.data);
        router.push({name: 'chats.index'});
    }

    function handleReject(e) {
        errors.value = e.response.data.errors;
    }


    const user = reactive({})

    async function setUser() {
        isLoading.value = true

        const userData = await getUser()
        Object.assign(user, userData);

        isLoading.value = false
    }

    async function getUser() {
        return await axios.get('/api/users/me').then(r => r.data.data)
    }


    onMounted(async () => {
        const isAuthenticated = localStorage.getItem('x_xsrf_token')

        if (isAuthenticated && !Object.keys(user).length) {
            await setUser()
        }
    })


    return {errors, attempt, create, user, isLoading}
}
