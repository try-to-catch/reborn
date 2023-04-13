import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/',
        component: () => import("@/views/IndexView.vue"),
        name: 'home',
    },
    {
        path: '/chats',
        component: () => import("@/views/Chat/ChatApp.vue"),
        props: route => ({routeId: parseInt(route.params.id) || 0}),
        meta: {
            middleware: 'auth'
        },
        children: [
            {
                path: '',
                component: () => import("@/views/Chat/IndexView.vue"),
                name: 'chats.index',
            },
            {
                path: ':id',
                component: () => import("@/views/Chat/ShowView.vue"),
                name: 'chats.show',
            }
        ]
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
    {
        path: '/forgot-password',
        component: () => import("@/views/Auth/ForgotPasswordView.vue"),
        name: 'forgotPassword',
        meta: {
            middleware: 'guest'
        }
    },
    {
        path: '/reset-password/:token',
        component: () => import("@/views/Auth/ResetPasswordView.vue"),
        name: 'resetPassword',
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
