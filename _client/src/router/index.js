import { createRouter, createWebHistory } from 'vue-router'
import TrackingView from '../views/TrackingView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/tracking',
      name: 'tracking',
      component: TrackingView
    }
  ]
})

export default router
