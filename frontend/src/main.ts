import { createHead } from '@unhead/vue';
import { createPinia } from 'pinia';
import { createApp } from 'vue';
import 'primeicons/primeicons.css';
import './assets/index.postcss';
import { router } from './router';
import App from './App.vue';
import 'clockwork-browser/metrics';
import 'clockwork-browser/toolbar';
import { defaultConfig, plugin } from '@formkit/vue';
import formkitConfig from '../formkit.config';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';

const head = createHead();
const app = createApp(App);

const pinia = createPinia();
app.use(pinia);
app.use(router);
app.use(plugin, defaultConfig(formkitConfig));
app.use(PrimeVue, {
  theme: {
    preset: Aura,
    options: {
      darkModeSelector: false,
    },
  }
});
app.use(head);

app.mount('#app');
