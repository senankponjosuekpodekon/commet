import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import SignUpView from '@/views/SignUpView.vue'
import DetailsView from '@/views/DetailsView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
    },
    {
      path: '/details/user/:userId/post/:postId',
      name: 'details',
      component: DetailsView,
      meta: { requiresAuth: true }
    },
    {
      path: '/register',
      name: 'register',
      component: SignUpView
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth) && !localStorage.getItem('userData')) {
    next({
      name: 'login',
      query: { redirect: to.fullPath }
    })
  }
  next()
})

export default router
