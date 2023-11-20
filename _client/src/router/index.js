import { createRouter, createWebHistory } from 'vue-router'
import GuardianView from '../views/GuardianView.vue'
import WardView from '../views/WardView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/guardian',
      name: 'guardian',
      component: GuardianView
    },
    {
      path: '/ward',
      name: 'ward',
      component: WardView
    }
  ]
})

export default router
