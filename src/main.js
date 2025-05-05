import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

// Font Awesome 相關設定
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'

library.add(faMagnifyingGlass)

const app = createApp(App)

app.use(createPinia())
app.use(router)

// 註冊全域元件
app.component('font-awesome-icon', FontAwesomeIcon)
app.mount('#app')
