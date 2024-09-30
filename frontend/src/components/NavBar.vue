<script setup lang="ts">
import { RouterLink, useRouter } from 'vue-router';
import { computed } from 'vue';
import { useMainStore } from '@/store';

const router = useRouter();
const store = useMainStore();

const isAuthenticated = computed(() => {
  return store.isAuthenticated;
})

const isGuest = computed(() => {
  return store.isGuest;
})

const logout = async () => {
  await store.logout()
  if (store.isGuest) {
    router.push({ name: 'home' })
  }
};
</script>

<template>
  <nav class="bg-white shadow dark:bg-gray-800">
    <div class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
      <RouterLink :to="{ name: 'home' }" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Home</RouterLink>
      <RouterLink v-if="isAuthenticated" :to="{ name: 'character-select' }" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Character Select</RouterLink>
      <RouterLink v-if="isGuest" :to="{ name: 'login' }" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Login</RouterLink>
      <a
        v-else
        class="cursor-pointer text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6"
        @click="logout"
      >
        Logout
      </a>
    </div>
  </nav>
</template>
