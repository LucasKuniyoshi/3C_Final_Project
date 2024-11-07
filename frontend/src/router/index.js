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
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Login.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('../views/Signin.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/signinRecruiter',
      name: 'signinRecruiter',
      component: () => import('../views/SigninRecruiter.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/jobs',
      name: 'jobs',
      component: () => import('../views/Jobs.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('../views/Dashboard.vue'),
      meta: {
        title: 'Recruta Fácil'
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
