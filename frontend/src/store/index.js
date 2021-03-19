import Vue from 'vue'
import Vuex from 'vuex'
import api from "@/api/api";

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
      auth: {
          state: {
              token: sessionStorage.token ? JSON.parse(sessionStorage.getItem('token')) : null,
              products: sessionStorage.products ? JSON.parse(sessionStorage.getItem('products')) : null
          },
          getters: {
              token: state => state.token,
              products: state => state.products,
              authenticated: state => state.token !== null,
          },
          mutations: {
              SET_TOKEN(state, token) {
                  state.token = token;
              },
              SET_PRODUCTS(state, products) {
                  state.products = products;
              }
          },
          actions: {
              async login({commit}, user) {
                  user.device_name = "spa"
                  const {data} = await api.post("/sanctum/token", user);
                  commit('SET_TOKEN', data)
                  sessionStorage.token = JSON.stringify(data);
              },
              async logout({commit}) {
                  api.defaults.headers.common['Authorization'] = 'Bearer ' + this.state.auth.token
                  await api.delete('/logout');
                  commit('SET_TOKEN', null);
                  sessionStorage.removeItem('token');
              },
              async getProducts({ commit }) {
                api.defaults.headers.common['Authorization'] = 'Bearer ' + this.state.auth.token
                const  { data }  = await api.get('/products');
                commit('SET_PRODUCTS', data)
                sessionStorage.products = JSON.stringify(data);
              }
          }
      }
    }
  }
)
