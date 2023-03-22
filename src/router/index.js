import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  // history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'error',
      component: () => import('../views/Error.vue')
    },
  
    {
      path: '/register',
      name: 'register',
      component: () => import('../components/RegisterForm.vue')

    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../components/LoginForm.vue')
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/pages/User.vue')
    },

  ]
})

export default router
