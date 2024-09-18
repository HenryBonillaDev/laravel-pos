<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
    product: {type: Object}
});
</script>

<template>
    <Head title="Productos"/>
    <AuthenticatedLayout>
        <template #header>
            Productos
        </template>

        <div>
        <h1>Lista de Productos</h1>

        <table>
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio de Venta</th>
                <th>Otro Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.sale_price }}</td>
                <td>{{ product.other_price }}</td>
                <td>{{ product.id_category }}</td>
                <td>{{ product.stock }}</td>
            </tr>
            </tbody>
        </table>
    </div>


    </AuthenticatedLayout>
</template>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
</style>
