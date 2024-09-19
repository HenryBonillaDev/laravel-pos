<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from 'vue';
import Create from './Create.vue';

// Props
const props = defineProps({
    products: {type: Array},
    categories:{type: Array}
});


// Estado reactivo para manejar el modal
const showModal = ref(false);

// Método para cerrar el modal
const closeModal = () => {
    showModal.value = false;
};

onMounted(() => {
    console.log('Productos recibidos:', props.products);
});
</script>

<template>
    <Head title="Productos"/>
    <AuthenticatedLayout>
        <template #header>
            Productos
        </template>

        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-4">Lista de Productos</h1>

            <!-- Botón para abrir el modal -->
            <button @click="showModal = true" class="bg-blue-500 text-white px-4 py-2 mb-4">Agregar Producto</button>

            <!-- Tabla de productos -->
            <table class="table-auto w-full mb-6">
                <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Stock</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Precio de venta</th>
                    <th class="px-4 py-2">Otro precio</th>
                    <th class="px-4 py-2">Categoría</th>
                    <th class="px-4 py-2">Es bebida</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id" class="text-gray-700">
                    <td class="border px-4 py-2">{{ product.name }}</td>
                    <td class="border px-4 py-2">{{ product.stock }}</td>
                    <td class="border px-4 py-2">{{ product.price }}</td>
                    <td class="border px-4 py-2">{{ product.sale_price }}</td>
                    <td class="border px-4 py-2">{{ product.other_price }}</td>
                    <td class="border px-4 py-2">{{ product.category }}</td>
                    <td class="border px-4 py-2">{{ product.is_drink ? 'Sí' : 'No' }}</td>
                </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div v-if="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded shadow-lg w-1/2">
                    <!-- Botón para cerrar el modal -->
                    <button @click="showModal = false" class="text-red-500 float-right">Cerrar</button>

                    <!-- Componente Create (Formulario) -->
                    <Create :categories="categories" @close="closeModal"></Create>
                </div>
            </div>
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
