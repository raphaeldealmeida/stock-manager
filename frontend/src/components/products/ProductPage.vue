<template>
    <v-container>
        <v-card>
            <v-card-title>
                Product list
            </v-card-title>
            <v-card-text>
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
          products: [
            {
              id: 1,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 2,
              name: 'Product 1',
              price: 6.0,
              quantity: 24,
            },
            {
              id: 3,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 4,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 5,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 6,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 7,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 8,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 9,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },
            {
              id: 10,
              name: 'Product 1',
              price: 6.00,
              quantity: 24,
            },

          ],
        }),
    }
</script>

<style scoped>

</style>