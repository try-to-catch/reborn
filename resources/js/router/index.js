import {createRouter, createWebHistory} from "vue-router";


const routes = [
    {
        path: '/',
        component: () => import("@/views/Chat/IndexView.vue"),
        name: 'home'
    },
    {
        path: '/login',
        component: () => import("@/views/Auth/LoginView.vue"),
        name: 'login'
    },
    {
        path: '/sign-up',
        component: () => import("@/views/Auth/RegisterView.vue"),
        name: 'register'
    },
]

const router = createRouter({history: createWebHistory(), routes})

export default router
