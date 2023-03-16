<template>
    <auth-layout title="Create new account">

        <form class="space-y-4 md:space-y-6" action="#" @submit.prevent="register">
            <default-input v-model="credentials.username" id="username" type="text" placeholder="your_awesome_username"
                           :errors="errors.username">
                Username
            </default-input>
            <default-input v-model="credentials.email" id="email" type="email" placeholder="name@company.com"
                           :errors="errors.email">
                Your email
            </default-input>
            <default-input v-model="credentials.password" id="password" type="password" placeholder="••••••••"
                           :errors="errors.password">
                Password
            </default-input>
            <default-input v-model="credentials.password_confirmation" id="password_confirmation" type="password"
                           placeholder="••••••••" :showErrors="false" :errors="errors.password">
                Confirm password
            </default-input>
            <!--            <div>-->
            <!--                <label for="password_confirmation"-->
            <!--                       class="block mb-2 text-sm font-medium text-white">Confirm password</label>-->
            <!--                <input v-model.trim="credentials.password_confirmation" type="password" id="password_confirmation" placeholder="••••••••"-->
            <!--                       class="border sm:text-sm rounded-lg block w-full p-2.5 bg-main-700 border-main-300 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-main-500"-->
            <!--                       required="">-->
            <!--            </div>-->
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                               class="w-4 h-4 border rounded focus:ring-3 bg-main-700 border-gray-600 focus:ring-primary-600 ring-offset-gray-800"
                               required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-300">
                            Accept user
                            <a href="#" class="font-bold hover:underline">terms</a>
                        </label>
                    </div>
                </div>
            </div>
            <gray-button>
                Sign up
            </gray-button>
            <p class="text-sm font-light text-gray-400">
                Already have an account?
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
import DefaultInput from "@/components/Form/DefaultInput.vue";
import {computed, reactive} from "vue";

export default {
    name: "RegisterView",
    components: {DefaultInput, GrayButton, AuthLayout},
    setup() {
        const {create, errors} = useUser()


        const credentials = reactive({
            username: '',
            email: '',
            password: '',
            password_confirmation: '',
        })


        const isFilled = computed(() => {
            return credentials.username && credentials.username && credentials.password && credentials.password_confirmation
        })

        function register() {
            if (isFilled) {
                create(credentials)
            }

        }

        return {credentials, errors, register}
    }
}
</script>

<style scoped>

</style>
