<template>
  <v-card>
    <v-card-title>{{ product.name }}</v-card-title>
    <v-row>
      <v-col>
        Price: {{ product.price }}
      </v-col>
      <v-col>
        Quantity: {{ product.quantity }}
      </v-col>
    </v-row>
    <v-card-text>
      <v-data-table
          :headers="headers"
          :items="history"
          :items-per-page="5"
          item-key="id"
      ></v-data-table>
    </v-card-text>
    <v-card-actions></v-card-actions>
  </v-card>

</template>

<script>
    export default {
        name: "ProductDetails",
        data: () => ({
          headers: [
            {text: 'ID', value: 'id'},
            {text: 'Quantity (UN)', value: 'quantity', align: 'start'},
            {text: 'Date', value: 'date'},
          ],
          product: {id: 1, name: "Product 1", quantity: 11, price: 23.00},
          history: [
            {id: 1, quantity: 22, date: Date.now()},
            {id: 2, quantity: 22, date: Date.now()},
            {id: 3, quantity: 22, date: Date.now()},
            {id: 4, quantity: 22, date: Date.now()},
            {id: 5, quantity: 22, date: Date.now()},
            {id: 6, quantity: 22, date: Date.now()},
          ]
        }),
    }
</script>

<style scoped>

</style>