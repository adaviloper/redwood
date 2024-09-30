<script setup lang="ts">
import { useRoute } from 'vue-router';
import { useHead } from '@unhead/vue';
import { onMounted } from 'vue';
import NavBar from './components/NavBar.vue';
import { useMainStore } from './store';
// See vite.config.ts for details about automatic imports
const store = useMainStore();
const route = useRoute();

useHead({
  title: () => route.meta?.title || 'Vite + Vue Template',
  meta: [
    {
      property: 'og:title',
      content: () => route.meta?.title,
    },
    {
      name: 'twitter:title',
      content: () => route.meta?.title,
    },
  ],
})

onMounted(() => {
  store.initApp();
});

const VERSION = import.meta.env.VITE_APP_VERSION
const BUILD_DATE = import.meta.env.VITE_APP_BUILD_EPOCH
  ? new Date(Number(import.meta.env.VITE_APP_BUILD_EPOCH))
  : undefined
const thisYear = new Date().getFullYear()
</script>

<template>
  <div class="relative py-8">
    <div
      class="absolute inset-0 bg-[url(/img/grid.svg)] bg-top [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"
    />
    <div class="container relative max-w-4xl mx-auto bg-white shadow-xl shadow-slate-700/10 ring-1 ring-gray-900/5">
      <header class="px-4 pt-6 prose-sm md:px-6">
        <NavBar />
      </header>
      <main>
        <Suspense>
          <router-view />
        </Suspense>
      </main>
      <footer class="py-6 text-sm text-center text-gray-700">
        <p>
          Vite-ts-tailwind-starter by
          <a class="underline" href="https://twitter.com/uninen">@Uninen</a> &copy; 2020-{{ thisYear }}.
          <template v-if="BUILD_DATE"> Site built {{ BUILD_DATE.toLocaleDateString() }}. </template>
          <template v-else> Development mode. </template>
        </p>
      </footer>
    </div>
  </div>
</template>
