import { createRouter, createWebHistory } from 'vue-router'
import TugasList from '../views/TugasList.vue'
import TentangAplikasi from '../views/TentangAplikasi.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', name: 'tugas', component: TugasList },
    { path: '/tentang', name: 'tentang', component: TentangAplikasi },
  ],
})

export default router
