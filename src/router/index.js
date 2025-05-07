import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import ProductDetail from '../views/ProductDetail.vue'
import RegisterPage from '../views/RegisterPage.vue'
import LoginPage from '../views/LoginPage.vue'
import OrderPage from '../views/OrderPage.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
  },
  {
    path: '/product/:id',
    component: ProductDetail,
    props: true
  },
  {
    path: '/register',
    component: RegisterPage,
  },
  {
    path: '/login',
    component: LoginPage,
  },,
  {
    path: '/order',
    component: OrderPage,
  },
]


const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router
