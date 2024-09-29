import { createRoute, createRouter } from '@kitbag/router'

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

export const router = createRouter(
  [
    createRoute({
      path: '/',
      name: 'home',
      component: IndexPage,
    }),
    createRoute({
      path: '/login',
      name: 'login',
      component: LoginPage,
      onBeforeRouteEnter: (to, { abort }) => {
        if (authGuest()) {
          abort();
        }
      },
    }),
    createRoute({
      path: '/character-select',
      name: 'character-select',
      component: CharacterSelectPage,
      onBeforeRouteEnter: (to, { abort }) => {
        if (authGuard()) {
          abort();
        }
      },
    }),
    createRoute({
      path: '/character',
      name: 'character',
      component: CharacterDetailPage,
      onBeforeRouteEnter: (to, { abort }) => {
        if (authGuard()) {
          abort();
        }
      },
    }),
  ],
  {
    rejections: {
      Unauthenticated: LoginPage,
    }
  }
)

