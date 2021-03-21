<template>
    <v-card>
            <v-card-title>ProductForm</v-card-title>
            <v-card-text>
                <v-form
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-row justify="center">
                    <v-col
                        cols="12"
                    >
                        <v-text-field
                            v-model="product.name" label="Name" clearable
                            name="name"
                            :rules="[rules.required]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                    >
                        <v-text-field
                            v-model="product.price" label="Price"
                            name="price"
                            prefix="$" type="number"
                            :rules="[rules.required]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                    >
                        <v-text-field
                            type="number"  v-model="product.current_quantity"
                            name="quantity"
                            label="Quantity" :rules="[rules.required]"
                        ></v-text-field>
                    </v-col>

                </v-row>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="close"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="save"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
</template>

<script>
    export default {
        name: "ProductForm",
        props: {
            product: Object,
        },
        data: () => ({
            dialog: true,
            valid: false,
            rules: {
                required: value => !!value || 'Required.',
            }
        }),
        methods:{
            save (){
                this.valid = false
                this.valid = this.$refs.form.validate()
                if(this.valid){
                    this.$emit('save', this.product)
                    this.clearCurrentProduct()
                }
            },
            close (){
                this.$emit('close')
                this.clearCurrentProduct()
            },
            clearCurrentProduct(){
                this.product = {id: '', name: '', price: '', current_quantity: ''}
            },
        }
    }
</script>

<style scoped>

</style>