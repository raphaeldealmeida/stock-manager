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
                            v-model="model.name" label="Name" clearable
                            :rules="[rules.required]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                    >
                        <v-text-field
                            v-model="model.price" label="Price"
                            prefix="$" type="number"
                            :rules="[rules.required]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                    >
                        <v-text-field
                            type="number"  v-model="model.current_quantity"
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
                    Salve
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
        mounted() {
            if(this.product.name !== '') {
                this.model = Object.assign({}, this.product)
            }
        },
        data: () => ({
            dialog: true,
            model: {
                id: '',
                name: '',
                price: '',
                current_quantity: '',
            },
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
                    this.$emit('save', this.model)
                    this.clear()
                }
            },
            close (){
                this.$emit('close')
                this.clear()
            },
            clear(){
                this.model = {id: '', name: '', price: '', current_quantity: ''}
            },
        }
    }
</script>

<style scoped>

</style>