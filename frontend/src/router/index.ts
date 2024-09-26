import { createRoute, createRouter } from '@kitbag/router'

import CharacterView from '@/pages/CharacterView.vue'
import IndexPage from '@/pages/IndexPage.vue'

export const router = createRouter([
  createRoute({
    path: '/',
    name: 'root',
    component: IndexPage,
    meta: {
      title: 'Vite + Vue + TypeScript + Tailwind Starter Template',
    },
  }),
  createRoute({
    path: '/character',
    name: 'character',
    component: CharacterView,
    meta: {
      title: 'Demo title',
    },
  }),
])

