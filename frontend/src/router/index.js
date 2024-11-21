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
      path: '/candidate/jobs',
      name: '/candidate/jobs',
      component: () => import('../views/Jobs.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/candidate/jobs/candidateVagas',
      name: '/candidate/jobs/candidateVagas',
      component: () => import('../views/CandidateVagas.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/recruiter/dashboard',
      name: '/recruiter/dashboard',
      component: () => import('../views/Dashboard.vue'),
      meta: {
        title: 'Recruta Fácil'
      }
    },
    {
      path: '/recruiter/dashboard/recruiterVagas',
      name: '/recruiter/dashboard/recruiterVagas',
      component: () => import('../views/RecruiterVagas.vue'),
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
  const publicPages = ["/login", "/signin", "/signinRecruiter", "/"]; // Rotas públicas
  const authRequired = !publicPages.includes(to.path); // Rotas protegidas
  const loggedIn = localStorage.getItem("user"); // Verifica se o usuário está logado

  // Verifica se o usuário está tentando acessar uma rota protegida sem estar logado
  if (authRequired && !loggedIn) {
    return next("/login"); // Redireciona para o login
  }

  // Verifica o tipo de usuário e impede acesso a rotas de outro tipo
  if (loggedIn) {
    const user = JSON.parse(localStorage.getItem("user"));
    if (user.user_type === "candidate" && to.path.startsWith("/recruiter")) {
      return next("/candidate/jobs"); // Redireciona candidato para as vagas
    }
    if (user.user_type === "recruiter" && to.path.startsWith("/candidate")) {
      return next("/recruiter/dashboard"); // Redireciona recrutador para o dashboard
    }
  }

  // Define o título da página
  document.title = to.meta.title || "Recruta Fácil";

  next(); // Prossegue para a rota
});


/*router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});*/

export default router
