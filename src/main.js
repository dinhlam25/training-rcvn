import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { defineComponent } from 'vue'

import App from './App.vue'
import router from './router'
import axios from './axios'
import './assets/main.css'

const app = createApp(App)
app.use(createPinia())
app.use(router)
app.use(axios)
app.mount('#app')