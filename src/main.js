import { createApp } from 'vue'
import { createPinia } from 'pinia'

import Paginate from "vuejs-paginate-next";
import App from './App.vue'
import router from './router'
import axios from './axios'
import './assets/main.css'

const app = createApp(App)
app.use(createPinia())
app.use(Paginate)
app.use(router)
app.use(axios)
app.mount('#app')