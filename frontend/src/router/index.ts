import { createRoute, createRouter } from '@kitbag/router'

import CharacterDetailPage from '@/pages/CharacterDetailPage.vue'
import IndexPage from '@/pages/IndexPage.vue'
import LoginPage from '@/pages/LoginPage.vue'
import CharacterSelectPage from '@/pages/CharacterSelectPage.vue'

export const router = createRouter([
  createRoute({
    path: '/',
    name: 'root',
    component: IndexPage,
  }),
  createRoute({
    path: '/login',
    name: 'login',
    component: LoginPage,
  }),
  createRoute({
    path: '/character-select',
    name: 'character-select',
    component: CharacterSelectPage,
  }),
  createRoute({
    path: '/character',
    name: 'character',
    component: CharacterDetailPage,
  }),
])

