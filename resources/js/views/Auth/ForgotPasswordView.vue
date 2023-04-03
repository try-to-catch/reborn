<template>
    <auth-layout title="Password recovery">
        <form class="space-y-4 md:space-y-6" @submit.prevent="sendLink">
            <default-input v-model="email" id="email" type="email" placeholder="name@company.com"
                           :errors="errors.email">
                Your email
            </default-input>
            <gray-button :isDisabled="isDisabled">
                {{buttonText}}
            </gray-button>
            <p class="text-sm font-light text-gray-400">
                Remember your password?
                <router-link :to="{name: 'login'}"
                             class="font-medium hover:underline text-gray-300">
                    Sign in
                </router-link>
            </p>
        </form>
    </auth-layout>
</template>

<script>
import AuthLayout from "@/components/Layouts/AuthLayout.vue";
import GrayButton from "@/components/Buttons/GrayButton.vue";
import useUser from "@/composables/user";
import {computed, ref} from "vue";
import DefaultInput from "@/components/Form/DefaultInput.vue";


export default {
    name: "ForgotPasswordView",
    components: {DefaultInput, GrayButton, AuthLayout},
    setup() {
        const {errors, forgotPassword} = useUser()

        const email = ref('')
        const isSubmit = ref(false)

        const isDisabled = computed(() => {
            const emailPattern = /[a-z|\d]*@[a-z|\d]*.[a-z|\d]*/

            return !(emailPattern.test(email.value) && !isSubmit.value)
        })

        const buttonText = computed(() => {
            return !isSubmit.value? 'Send Link': 'Link sent. Check your email!'
        })

        async function sendLink() {
                if (await forgotPassword(email.value)){
                    isSubmit.value = true;
                }
        }

        return {email, errors, isDisabled, sendLink, buttonText}
    }
}
</script>
