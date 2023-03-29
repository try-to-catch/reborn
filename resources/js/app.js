import './bootstrap';
import {createApp} from 'vue'
import './../css/app.css'
import App from './App.vue'
import router from "@/router"

import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {faAt, faGear, faMagnifyingGlass, faSquareCheck, faUserGroup} from '@fortawesome/free-solid-svg-icons'

const app = createApp({})

library.add(faUserGroup, faGear, faAt, faMagnifyingGlass, faSquareCheck)

app.component('App', App)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(router)
    .mount('#app')
