import { createApp } from 'vue'
import './assets/app.css'
import App from './App.vue'
import router from './router'
import axios from "axios"
import store from './store'

axios.defaults.baseURL = 'http://localhost/api'
axios.defaults.withCredentials = true

store.dispatch('authenticate').then(() => {
    createApp(App).use(router).use(store).mount('#app')
})
