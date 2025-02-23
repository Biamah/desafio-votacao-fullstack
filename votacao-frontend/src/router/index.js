import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import Pautas from '../views/Pautas.vue'
import Sessoes from '../views/Sessoes.vue'
import Votos from '../views/Votos.vue'

const routes = [
  {
    path: '/',
    component: Login,
  },
  {
    path: '/dashboard',
    component: Dashboard,
    children: [
      { path: 'pautas', component: Pautas },
      { path: 'sessoes', component: Sessoes },
      { path: 'votos', component: Votos },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
