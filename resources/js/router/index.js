import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        component: () => import("@/views/IndexView.vue"),
        name: 'home',
    },
    {
        path: '/chats',
        component: () => import("@/views/Chat/IndexView.vue"),
        name: 'chats.index',
        meta: {
            middleware: 'auth'
        }
    },
    {
        path: '/chats/:id',
        component: () => import("@/views/Chat/ShowView.vue"),
        name: 'chats.show',
        meta: {
            middleware: 'auth'
        }
    },
    {
        path: '/login',
        component: () => import("@/views/Auth/LoginView.vue"),
        name: 'login',
        meta: {
            middleware: 'guest'
        }
    },
    {
        path: '/sign-up',
        component: () => import("@/views/Auth/RegisterView.vue"),
        name: 'register',
        meta: {
            middleware: 'guest'
        }
    },
]

const router = createRouter({history: createWebHistory(), routes})


router.beforeEach(async (to, from) => {
    const isAuthenticated = Boolean(localStorage.getItem('x_xsrf_token'))
    const middleware = to.meta['middleware']

    if (middleware === 'auth' && !isAuthenticated) {

        return {
            name: 'login',
            // query: {redirect: to.fullPath},
        }

    } else if (middleware === 'guest' && isAuthenticated) {
        return {
            name: from.name ?? 'home'
        }
    }

})

export default router
