<template>
  <v-container>
    <v-card>
      <v-card-title>{{ product.code }} - {{ product.name }}</v-card-title>
      <v-row>
        <v-col>
          Price: {{ product.price }}
        </v-col>
        <v-col>
          Quantity: {{ product.current_quantity }}
        </v-col>
      </v-row>
      <v-card-text>
        <v-data-table
            :headers="headers"
            :items="quantityHistory"
            :items-per-page="5"
            item-key="id"
        ></v-data-table>
      </v-card-text>
      <v-card-actions></v-card-actions>
    </v-card>
  </v-container>
</template>

<script>
    export default {
        name: "ProductDetails",
        props: {
            product: Object,
            quantityHistory: Array,
        },
        data: () => ({
          headers: [
            {text: 'Quantity (UN)', value: 'quantity', align: 'start'},
            {text: 'Date', value: 'quantity_at'},
          ],
        }),
    }
</script>

<style scoped>

</style>