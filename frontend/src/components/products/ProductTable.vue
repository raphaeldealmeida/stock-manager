<template>
    <v-data-table
            :headers="headers"
            :items="products"
            :items-per-page="5"
            item-key="id"
    >
        <template v-slot:item.actions="{ item }">
            <v-icon
                    small
                    class="mr-2"
                    @click="$emit('edit-item', item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                    small
                    @click="$emit('delete-item', item)"
            >
                mdi-delete
            </v-icon>
        </template>
    </v-data-table>
</template>

<script>
    export default {
        name: "ProductTable",
        props: {
            products: Array,
        },
        data: () => ({
                headers: [
                    {text: 'ID', value: 'id'},
                    {text: 'Name', value: 'name', align: 'start'},
                    {text: 'Price (U$)', value: 'price'},
                    {text: 'Quantity (UN)', value: 'current_quantity'},
                    {text: 'Actions', value: 'actions', sortable: false},
                ],
        }),
        methods: {
            // editItem (item) {
            //     this.editedIndex = this.products.indexOf(item)
            //     this.editedItem = Object.assign({}, item)
            //     this.dialog = true
            // },
            // deleteItem (item) {
            //     this.editedIndex = this.products.indexOf(item)
            //     this.editedItem = Object.assign({}, item)
            //     this.dialogDelete = true
            // },
            // deleteItemConfirm () {
            //   this.products.splice(this.editedIndex, 1)
            //   this.closeDelete()
            // },
            // close () {
            //   this.dialog = false
            //   this.$nextTick(() => {
            //     this.editedItem = Object.assign({}, this.defaultItem)
            //     this.editedIndex = -1
            //   })
            // },
            // closeDelete () {
            //   this.dialogDelete = false
            //   this.$nextTick(() => {
            //     this.editedItem = Object.assign({}, this.defaultItem)
            //     this.editedIndex = -1
            //   })
            // },
            // save () {
            //   if (this.editedIndex > -1) {
            //     Object.assign(this.products[this.editedIndex], this.editedItem)
            //   } else {
            //     this.products.push(this.editedItem)
            //   }
            //   this.close()
            // },
        }
    }
</script>

<style scoped>

</style>