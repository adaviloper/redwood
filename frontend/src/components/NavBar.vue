<script setup lang="ts">
import { RouterLink, useRouter } from 'vue-router';
import { computed, ref } from "vue";
import Menubar from 'primevue/menubar';
import { useUserStore } from '@/store/user';

const router = useRouter();
const store = useUserStore();

const isAuthenticated = computed(() => {
  return store.isAuthenticated;
})

const isGuest = computed(() => {
  return store.isGuest;
})

const items = ref([
  {
    label: 'Home',
    icon: 'pi pi-home',
    route: { name: 'home' },
  },
  {
    label: 'Character Select',
    icon: 'pi pi-palette',
    visible: () => isAuthenticated.value,
    route: { name: 'character-select' },
  },
  {
    label: 'My Characters',
    icon: 'pi pi-palette',
    route: { name: 'player-character-list' },
    visible: () => isAuthenticated.value,
  },
  {
    label: 'Admin',
    visible: () => isAuthenticated.value,
    items: [
      {
        label: 'Scenarios',
        route: { name: 'admin.scenarios.index' },
      }
    ],
  },
  {
    label: 'Logout',
    icon: 'pi pi-palette',
    visible: () => isAuthenticated.value,
    command: () => { logout() },
  },
  {
    label: 'Login',
    icon: 'pi pi-palette',
    visible: () => isGuest.value,
    route: { name: 'login' },
  },
  // {
  //     label: 'Programmatic',
  //     icon: 'pi pi-link',
  //     command: () => {
  //         router.push('/introduction');
  //     }
  // },
  // {
  //     label: 'External',
  //     icon: 'pi pi-home',
  //     items: [
  //         {
  //             label: 'Vue.js',
  //             url: 'https://vuejs.org/'
  //         },
  //         {
  //             label: 'Vite.js',
  //             url: 'https://vitejs.dev/'
  //         }
  //     ]
  // }
]);
const logout = async () => {
  await store.logout()
  if (store.isGuest) {
    router.push({ name: 'home' })
  }
};
</script>

<template>
  <nav class="bg-white shadow dark:bg-gray-800 mb-6">
    <div class="card">
      <Menubar :model="items">
        <template #item="{ item, props, hasSubmenu }">
          <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
            <a :href="href" v-bind="props.action" @click="navigate">
              <span :class="item.icon" />

              <span class="ml-2">{{ item.label }}</span>
            </a>
          </router-link>

          <a v-else :href="item.url" :target="item.target" v-bind="props.action">
            <span :class="item.icon" />

            <span class="ml-2">{{ item.label }}</span>

            <span v-if="hasSubmenu" class="pi pi-fw pi-angle-down ml-2" />
          </a>
        </template>
      </Menubar>
    </div>
  </nav>
</template>
