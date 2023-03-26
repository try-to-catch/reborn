import axios from "axios";
import {onMounted, reactive, ref} from "vue";
import {useRouter} from "vue-router";

export default function useUser() {
    const router = useRouter()

    const errors = ref([])
    const user = reactive({})

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

        setUser(response.data.data)
        router.push({name: 'chats.index'});
    }

    function handleReject(e) {
        errors.value = e.response.data.errors;
    }


    onMounted(async () => {
        const isAuthenticated = localStorage.getItem('x_xsrf_token')

        if (isAuthenticated && !Object.keys(user).length) {
            await getUser().then(r => {
                Object.assign(user, r);
                console.log(user, 222)
            })
        }
    })

    function setUser(value) {
        Object.assign(user, value);
    }

    async function getUser() {
        isLoading.value = true

        const userData = await axios.get('/api/user').then(r => r.data.data)

        isLoading.value = false

        return userData
    }


    return {errors, attempt, create, user, isLoading}
}
