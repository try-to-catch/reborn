<template>
    <auth-layout title="Sign in to your account">
        <form class="space-y-4 md:space-y-6" @submit.prevent="login">
            <default-input v-model="credentials.email" id="email" type="email" placeholder="name@company.com" :errors="errors.email">
                Your email
            </default-input>
            <default-input v-model="credentials.password" id="password" type="password" placeholder="••••••••" :errors="errors.password">
                Password
            </default-input>
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input v-model="credentials.remember_me" id="remember" aria-describedby="remember" type="checkbox"
                               class="w-4 h-4 border rounded focus:ring-3 bg-main-700 border-gray-600 focus:ring-primary-600 ring-offset-gray-800"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-300">Remember me</label>
                    </div>
                </div>
                <a href="#" class="text-sm font-medium hover:underline text-gray-300">Forgot
                    password?</a>
            </div>
            <gray-button :isDisabled="!isFilled">
                Sign in
            </gray-button>
            <p class="text-sm font-light text-gray-400">
                Don’t have an account yet?
                <router-link :to="{name: 'register'}"
                             class="font-medium hover:underline text-gray-300">
                    Sign up
                </router-link>
            </p>
        </form>
    </auth-layout>
</template>

<script>
import AuthLayout from "@/components/Layouts/AuthLayout.vue";
import GrayButton from "@/components/Buttons/GrayButton.vue";
import useUser from "@/composables/user";
import {computed, reactive} from "vue";
import DefaultInput from "@/components/Form/DefaultInput.vue";


export default {
    name: "LoginView",
    components: {DefaultInput, GrayButton, AuthLayout},
    setup() {
        const {attempt, errors} = useUser()

        const credentials = reactive({
            email: '',
            password: '',
            remember_me: false,
        })


        const isFilled = computed(() => {
            return credentials.email && credentials.password
        })

        function login() {
            if (isFilled) {
                attempt(credentials)
            }
        }

        return {credentials, errors, isFilled, login}
    }
}
</script>
