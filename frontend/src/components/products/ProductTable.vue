<template>
    <v-data-table
            :headers="headers"
            :items="products"
            :items-per-page="5"
            item-key="id"
    >
        <template v-slot:item.actions="{ item }">
            <v-icon
                class="mr-4"
                @click="$emit('show-item', item)"
            >
                mdi-eye
            </v-icon>
            <v-icon
                    class="mr-4"
                    @click="$emit('edit-item', item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                    class="mr-4"
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
    }
</script>

<style scoped>

</style>