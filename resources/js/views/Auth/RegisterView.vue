<template>
    <auth-layout title="Create new account">

        <form class="space-y-4 md:space-y-6" action="#">
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Username
                </label>
                <input type="text" name="username" id="username"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-main-700 dark:border-main-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-main-500"
                       placeholder="your_awesome_username" required="">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Your email
                </label>
                <input type="email" name="email" id="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-main-700 dark:border-main-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-main-500"
                       placeholder="name@company.com" required="">
            </div>
            <div>
                <label for="password"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-main-700 dark:border-main-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-main-500"
                       required="">
            </div>
            <div>
                <label for="password_confirmation"
                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-main-700 dark:border-main-300 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-main-500"
                       required="">
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" type="checkbox"
                               class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-main-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                               required="">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="text-gray-500 dark:text-gray-300">Accept user <a href="#"
                                                                                                      class="font-bold hover:underline">terms</a></label>
                    </div>
                </div>
            </div>
            <button type="submit"
                    class="w-full text-white bg-main-800 hover:bg-main-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-main-600 dark:hover:bg-main-700 dark:focus:ring-main-800">
                Sign up
            </button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                Already have an account?
                <router-link :to="{name: 'login'}"
                             class="font-medium text-primary-600 hover:underline dark:text-gray-300">
                    Sign in
                </router-link>
            </p>
        </form>

    </auth-layout>
</template>

<script>
import AuthLayout from "@/components/Layouts/AuthLayout.vue";

export default {
    name: "RegisterView",
    components: {AuthLayout},
}
</script>

<style scoped>

</style>
