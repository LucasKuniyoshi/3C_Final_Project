import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        title: 'Home'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Login.vue'),
      meta: {
        title: 'Login'
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('../views/Signin.vue'),
      meta: {
        title: 'Signin'
      }
    },
    {
      path: '/signinRecruiter',
      name: 'signinRecruiter',
      component: () => import('../views/SigninRecruiter.vue'),
      meta: {
        title: 'SigninRecruiter'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Dashboard.vue'),
      meta: {
        title: 'Dashboard'
      }
    }
  ],
  scrollBehavior(to, from, savedPosition) {
    // Sempre rola para o topo
    return { top: 0 };
  },
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
