import { createRouter, createWebHistory } from 'vue-router'
import CharacterDetailPage from '@/pages/CharacterDetailPage.vue'
import CharacterSelectPage from '@/pages/CharacterSelectPage.vue'
import IndexPage from '@/pages/IndexPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import { useMainStore } from '@/store'

const authGuard = () => {
  const store = useMainStore();

  return !store.isAuthenticated;
}

const authGuest = () => {
  const store = useMainStore();

  return !store.isGuest;
}

const routes = [
  {
    path: '/',
    name: 'home',
    component: IndexPage,
  },
  {
    path: '/login',
    name: 'login',
    component: LoginPage,
  },
  {
    path: '/character-select',
    name: 'character-select',
    component: CharacterSelectPage,
  },
  {
    path: '/character',
    name: 'character',
    component: CharacterDetailPage,
  },
];

export const router = createRouter({
  history: createWebHistory(),
  routes,
});
