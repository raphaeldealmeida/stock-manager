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
            <v-dialog
                v-model="dialogShow"
                persistent
                max-width="600px"
            >
                <v-card>
                    <v-card-text>
                        <ProductDetails :product="currentProduct" :quantityHistory="quantityHistory" ></ProductDetails>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click="closeShowItem">Close</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-model="confirm"
                persistent
                max-width="600px"
            >
                <v-card>
                    <v-card-title>
                        Are you sure you want to delete this product?
                    </v-card-title>
                    <v-card-text class="body-1">
                        {{ currentProduct.name }}
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            class="mr-4 mb-1"
                            color="primary"

                            @click="confirm=false"
                        >
                            No
                        </v-btn>
                        <v-btn
                            class="mr-4 mb-1"
                            color="error"

                            @click="deleteProduct"
                        >
                            Yeh
                        </v-btn>
                    </v-card-actions>
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
              <ProductTable :products="products" v-on:edit-item="editItem" v-on:delete-item="deleteItem"
                            v-on:show-item="showItem"></ProductTable>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    import ProductTable from "./ProductTable";
    import ProductForm from "@/components/products/ProductForm";
    import ProductDetails from "@/components/products/ProductDetails";
    export default {
        components: {ProductDetails, ProductForm, ProductTable},
        name: "ProductPage",
        data: () => ({
            error: false,
            products: [],
            dialog: false,
            dialogShow:false,
            confirm: false,
            quantityHistory: [],
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
            closeShowItem(){
                this.clearCurrentProduct();
                this.clearHistory();
                this.dialogShow = false
            },
            async showItem(product) {
                try {
                    await this.$store.dispatch('getHistory', product);
                    this.quantityHistory = this.$store.getters.historic;
                    this.currentProduct = product
                    this.dialogShow = true
                } catch (error) {
                    this.error = error;
                }
            },
            async saveProduct (product) {
                this.dialog = false
                try {
                    let action = (product.id != '')?  'updateProduct' : 'createProduct';

                    await this.$store.dispatch(action, product);
                    this.clearCurrentProduct()
                } catch (error) {
                    this.error = error;
                    alert(error)
                }
              },
            editItem (product) {
                  this.currentProduct = product
                  this.dialog = true
              },
            deleteItem (product) {
                this.currentProduct = product
                this.confirm = true
            },
            async deleteProduct () {
                this.confirm = false
                try {
                    await this.$store.dispatch('deleteProduct', this.currentProduct);
                } catch (error) {
                    this.error = error;
                    alert(error)
                }
            },
            clearCurrentProduct () {
              this.currentProduct = { id: '',name: '',price: '',current_quantity: '',}
            },
            clearHistory () {
              this.quantityHistory = [];
            }
        },
    }
</script>

<style scoped>

</style>