<template>
    <auth-layout title="Enter a new password">
        <form class="space-y-4 md:space-y-6" @submit.prevent="reset">
            <default-input v-model="credentials.password" id="password" type="password" placeholder="••••••••"
                           :errors="errors.password">
                Password
            </default-input>
            <default-input v-model="credentials.password_confirmation" id="password_confirmation" type="password"
                           placeholder="••••••••" :showErrors="false" :errors="errors.password">
                Confirm password
            </default-input>
            <gray-button :isDisabled="isDisabled">
                Continue
            </gray-button>
        </form>
    </auth-layout>
</template>

<script>
import AuthLayout from "@/components/Layouts/AuthLayout.vue";
import GrayButton from "@/components/Buttons/GrayButton.vue";
import useUser from "@/composables/user";
import DefaultInput from "@/components/Form/DefaultInput.vue";
import {computed, reactive} from "vue";
import {useRoute, useRouter} from "vue-router";


export default {
    name: "ForgotPasswordView",
    components: {DefaultInput, GrayButton, AuthLayout},
    setup() {
        const {errors, resetPassword} = useUser()
        const route = useRoute()
        const router = useRouter()

        const credentials = reactive({
            email: route.query.email,
            token: route.params.token,
            password: '',
            password_confirmation: '',
        })

        const isDisabled = computed(() => {
            return !(credentials.password === credentials.password_confirmation && credentials.password.length >= 6)
        })

        async function reset() {
            if (await resetPassword(credentials)) {
                await router.push({name: 'chats.index'})
            }
        }

        return {credentials, errors, isDisabled, reset}
    }
}
</script>
