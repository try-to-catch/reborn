<template>
    <div>
        Index View
        <div class="space-x-2 text-blue-700 mt-10">
            <router-link :to="{ name: 'login'}">Login</router-link>
            <router-link :to="{ name: 'chats.index'}">Chats</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexView"
}
</script>

<style scoped>

</style>
