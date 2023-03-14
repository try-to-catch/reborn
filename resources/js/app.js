import './bootstrap';
import { createApp } from 'vue'
import './../css/app.css'
import App from './App.vue'
import router from "@/router"

const app = createApp({})

app.component('App', App)
app.use(router)
app.mount('#app')
