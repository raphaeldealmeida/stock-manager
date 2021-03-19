import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginForm from "@/components/session/LoginForm";
import ProductPage from "@/components/products/ProductPage";
import ProductDetails from "@/components/products/ProductDetails";
import ProfilePage from "@/components/session/ProfilePage";

Vue.use(VueRouter)

const routes = [
  { path: '/', redirect: '/login' },
  {
    path: '/login',
    name: 'Login',
    component: LoginForm
  },
  {
    path: '/products',
    name: 'Products',
    component: ProductPage
  },
  {
    path: '/products/:id',
    name: 'ProductsDetails',
    component: ProductDetails
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfilePage
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
