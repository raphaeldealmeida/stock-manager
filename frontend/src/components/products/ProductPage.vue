<template>
    <v-container>
        <v-card>
            <v-card-title>
                Product list
            </v-card-title>
            <v-card-text>
              <p v-if="error" style="color: red">{{ error }}</p>
              <ProductTable :products="products"></ProductTable>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    import ProductTable from "./ProductTable";
    export default {
        components: {ProductTable},
        name: "ProductPage",
        data: () => ({
          error: false,
          products: [],
        }),
        async mounted() {
          try {
            await this.$store.dispatch('getProducts');
            this.products  = this.$store.getters.products;
          } catch (error) {
            this.error = error;
          }
        },
    }
</script>

<style scoped>

</style>