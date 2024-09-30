import { createRouter, createWebHistory } from 'vue-router'
import CharacterDetailPage from '@/pages/CharacterDetailPage.vue'
import CharacterSelectPage from '@/pages/CharacterSelectPage.vue'
import IndexPage from '@/pages/IndexPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import { useMainStore } from '@/store'

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
    meta: {
      requiresGuest: true
    },
  },
  {
    path: '/character-select',
    name: 'character-select',
    component: CharacterSelectPage,
    meta: {
      requiresAuth: true,
    },
  },
  {
    path: '/my-characters/:id',
    name: 'player-character-detail',
    props: true,
    component: CharacterDetailPage,
    meta: {
      requiresAuth: true,
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, _) => {
  const store = useMainStore();
  if (!store.isInitialized) {
    await store.initApp()
  }
  console.log('typescript', store.isAuthenticated, store.user);
  if (to.meta.requiresAuth && !store.isAuthenticated) {
    return { name: 'login' };
  }
  if (to.meta.requiresGuest && !store.isGuest) {
    return { name: 'home' };
  }
})

export { router }
