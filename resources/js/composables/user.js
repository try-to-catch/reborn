import axios from "axios";
import {ref} from "vue";
import {useRouter} from "vue-router";

export default function useUser() {
    const router = useRouter()

    const user = ref({})
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
                        if (e.response.status === 401){

                        }
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

    function authentication(response){
        user.value = response.data.data
        localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])

        router.push({name: 'chats.index'})
    }


    return {user, errors, attempt, create}
}
