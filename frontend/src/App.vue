<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <v-toolbar-title>Stock Manager</v-toolbar-title>
      <v-icon>mdi-account-circle</v-icon>
    </v-app-bar>
    <v-main>
      <v-container>
        <ProductDetails/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
//import LoginForm from './components/session/LoginForm';
//import ProductPage from './components/products/ProductPage';

import ProductDetails from "@/components/products/ProductDetails";
export default {
  name: 'App',

  components: {
    ProductDetails,
  },

  data: () => ({
    //
  }),
};
</script>
