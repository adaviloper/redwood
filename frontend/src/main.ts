import { createHead } from '@unhead/vue'
import { createPinia } from 'pinia'
import { plugin, defaultConfig } from '@formkit/vue'
import formkitConfig from '../formkit.config'
import { createApp } from 'vue'
import './assets/index.postcss'
import { router } from './router'
import App from './App.vue'

const head = createHead()
const app = createApp(App)

const pinia = createPinia()
app.use(pinia)
app.use(router)
app.use(plugin, defaultConfig(formkitConfig))
app.use(head)

app.mount('#app')
