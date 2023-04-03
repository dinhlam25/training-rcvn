import { createRouter, createWebHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  // history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue'),
      beforeEnter(to, from, next) {
        const condition = localStorage.getItem('token')
        if (condition) {
          next({ name: 'userManagement' })
        }
        else {
          next()
        }
      }
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
      component: () => import('../components/LoginForm.vue'),
      beforeEnter(to, from, next) {
        const condition = localStorage.getItem('token')
        if (condition) {
          next({ name: 'userManagement' })
        }
        else {
          next()
        }
      }
    },
    {
      path: '/dashboardUser',
      name: 'userManagement',
      component: () => import('../views/pages/User.vue'),
      beforeEnter: (to, from, next) => {
        const condition = localStorage.getItem('token')
        if (condition) {
          next()
        } else {
          next({ name: 'login' })
        }
      }
    },
    {
      path: '/dashboardProduct',
      name: 'productManagement',
      component: () => import('../views/pages/Product.vue'),
      beforeEnter: (to, from, next) => {
        const condition = localStorage.getItem('token')
        if (condition) {

          next()
        } else {
          next({ name: 'login' })
        }
      },

      // children: [
      //   {
      //     path: 'detail',
      //     // name: 'detailProduct'
      //     component: () => import('../views/pages/DetailProduct.vue')
      //   }
      // ]
    },
    {            
          path: '/dashboardProduct/detail',
          // name: 'detailProduct'
          component: () => import('../views/pages/DetailProduct.vue')     
    }
  ]
})

export default router
