import { createRouter, createWebHistory } from 'vue-router'
import CharacterDetailPage from '@/pages/characters/CharacterDetailPage.vue'
import CharacterSelectPage from '@/pages/characters/CharacterSelectPage.vue'
import PlayerCharacterListPage from '@/pages/playerCharacters/PlayerCharacterListPage.vue'
import IndexPage from '@/pages/IndexPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import { useMainStore } from '@/store'
import DailyAdventurePage from '@/pages/adventure/DailyAdventurePage.vue'

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
    path: '/my-characters',
    name: 'player-character-list',
    component: PlayerCharacterListPage,
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
  {
    path: '/daily-adventure',
    name: 'daily-adventure',
    component: DailyAdventurePage,
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
  if (to.meta.requiresAuth && !store.isAuthenticated) {
    return { name: 'login' };
  }
  if (to.meta.requiresGuest && !store.isGuest) {
    return { name: 'home' };
  }
})

export { router }
