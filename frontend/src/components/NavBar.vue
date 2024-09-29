<script setup lang="ts">
import { useMainStore } from '@/store';
import { RouterLink } from '@kitbag/router';

const store = useMainStore();
</script>

<template>
  <nav class="bg-white shadow dark:bg-gray-800">
    <div class="container flex items-center justify-center p-6 mx-auto text-gray-600 capitalize dark:text-gray-300">
      <RouterLink :to="(resolve) => resolve('home')" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Home</RouterLink>
      <RouterLink v-if="store.isAuthenticated" :to="(resolve) => resolve('character-select')" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Character Select</RouterLink>
      <RouterLink v-if="store.isGuest" :to="(resolve) => resolve('login')" class="text-gray-800 transition-colors duration-300 transform dark:text-gray-200 border-b-2 border-blue-500 mx-1.5 sm:mx-6">Login</RouterLink>
    </div>
  </nav>
</template>
