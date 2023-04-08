<template>
    <div>
        Index View
        <div class="space-x-2 text-blue-700 mt-10">
            <template v-if="!isAuthenticated">
                <router-link :to="{ name: 'login'}">Login</router-link>
            </template>
            <template v-else>
                <router-link :to="{ name: 'chats.index'}">Chats</router-link>
                <a @click.prevent="logout" href="/logout">Logout</a>
            </template>
        </div>
    </div>
</template>

<script>
import useUser from "@/composables/user";

export default {
    name: "IndexView",
    setup() {
        const {isAuthenticated, logout} = useUser()

        return {isAuthenticated, logout}
    }
}
</script>
