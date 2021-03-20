<template>
    <v-container>
        <v-row justify="center">
            <v-dialog
                v-model="dialog"
                persistent
                max-width="600px"
            >
                <v-card>
                    <v-card-text>
                        <ProductForm
                            v-on:close="dialog = false"
                            v-on:save="saveProduct"
                            :product="currentProduct"
                        ></ProductForm>
                    </v-card-text>
                </v-card>
            </v-dialog>

        </v-row>
        <v-card>
            <v-card-title>
                Product list
            </v-card-title>
            <v-card-text>
                <v-row justify="end">
                    <v-btn
                        class="mr-4 mb-1"
                        color="primary"
                        @click="dialog=true"
                    >
                        New Product
                    </v-btn>
                </v-row>
              <p v-if="error" style="color: red">{{ error }}</p>
              <ProductTable :products="products" v-on:edit-item="editItem" v-on:delete-item="deleteItem"></ProductTable>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    import ProductTable from "./ProductTable";
    import ProductForm from "@/components/products/ProductForm";
    export default {
        components: {ProductForm, ProductTable},
        name: "ProductPage",
        data: () => ({
          error: false,
          products: [],
          dialog: false,
            currentProduct: {
                id: '',
                name: '',
                price: '',
                current_quantity: '',
            },
        }),
        async mounted() {
          try {
            await this.$store.dispatch('getProducts');
            this.products  = this.$store.getters.products;
          } catch (error) {
            this.error = error;
          }
        },
        methods: {
        async saveProduct (product) {
            this.dialog = false
            try {
                //console.log(product)
                if(product.id != '') {
                    await this.$store.dispatch('updateProduct', product);
                }else {
                    await this.$store.dispatch('createProduct', product);
                }
            } catch (error) {
                this.error = error;
                alert(error)
            }

          },
          editItem (product) {
            console.log(product)
              this.currentProduct = product
              this.dialog = true
          },
          deleteItem (item) {
            alert(item)
          },
        },
    }
</script>

<style scoped>

</style>