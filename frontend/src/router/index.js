import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginForm from "@/components/session/LoginForm";
import ProductPage from "@/components/products/ProductPage";
import ProfilePage from "@/components/session/ProfilePage";

import middleware from "@/router/middleware"

Vue.use(VueRouter)

const routes = [
  { path: '/', redirect: '/login' },
  {
    path: '/login',
    name: 'Login',
    component: LoginForm,
  },
  {
    path: '/products',
    name: 'Products',
    component: ProductPage,
    beforeEnter: middleware
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfilePage,
    beforeEnter: middleware
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
