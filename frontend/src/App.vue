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

    <div class="relative mx-auto bg-white shadow-xl shadow-slate-700/10 ring-1 ring-gray-900/5">
      <header class="px-4 pt-6 prose-sm md:px-6">
        <NavBar />
      </header>

      <main>
        <Suspense>
          <router-view />
        </Suspense>
      </main>

      <footer class="py-6 text-sm text-center text-gray-700">
        <!---->
      </footer>
    </div>
  </div>
</template>

<style lang="postcss">
h1 {
  @apply text-5xl
}

h2 {
  @apply text-4xl
}

h3 {
  @apply text-3xl
}

h4 {
  @apply text-2xl
}

h5 {
  @apply text-xl
}

h6 {
  @apply text-lg
}

h1, h2, h3, h4, h5, h6 {
  @apply mb-3
}

p {
  @apply text-base mb-1
}
</style>
