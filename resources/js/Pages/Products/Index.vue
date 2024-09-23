<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from 'vue';
import Create from './Create.vue';
import Edit from './Edit.vue'

// Props
const props = defineProps({
    products: {type: Array},
    categories:{type: Array}
});

const showEditModal = ref(false);
const selectedProduct = ref(null);

// Estado reactivo para manejar el modal
const showModal = ref(false);

// Método para cerrar el modal
const closeModal = () => {
    showModal.value = false;
};

onMounted(() => {
    console.log('Productos recibidos:', props.products);
});

const openEditModal = (product) => {
    selectedProduct.value = product;
    showEditModal.value = true;
};

const closeEditModal = () => {
    showEditModal.value = false;
};
const openDeleteModal = (customer) => {
    currentCustomer.value = customer;
    showDeleteModal.value = true;
};
</script>

<template>
    <Head title="Productos"/>
    <AuthenticatedLayout>
        <div class="w-full overflow-x-auto">
            <!-- Botón para abrir el modal -->
            <button @click="showModal = true" class="bg-blue-500 rounded text-white px-4 py-2 mb-4">Agregar Producto</button>


            <!-- Tabla de productos -->
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Precio de venta</th>
                    <th class="px-4 py-3">Otro precio</th>
                    <th class="px-4 py-3">Categoría</th>
                    <th class="px-4 py-3">Es bebida</th>
                    <th class="px-4 py-3 flex justify-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id" class="text-gray-700">
                    <td class="px-4 py3 text-sm">{{ product.name }}</td>
                    <td class="px-4 py3 text-sm">{{ product.stock }}</td>
                    <td class="px-4 py3 text-sm">{{ product.price }}</td>
                    <td class="px-4 py3 text-sm">{{ product.sale_price }}</td>
                    <td class="px-4 py3 text-sm">{{ product.other_price }}</td>
                    <td class="px-4 py3 text-sm">{{ product.category.name }}</td>
                    <td class="px-4 py3 text-sm">{{ product.is_drink ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py3 text-sm flex justify-center">
                        <button @click="openEditModal(product)">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1"
                                      d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>

                        </button>
                        <button @click="openDeleteModal(product)">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="1"
                                      d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>

                        </button>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- Modal -->
            <div v-if="showModal" class="modal-overlay">
<!--                "fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">-->
                <div class="bg-white p-6 rounded shadow-lg w-1/2">
                    <!-- Botón para cerrar el modal -->
<!--                    <button @click="showModal = false" class="text-red-500 float-right">Cerrar</button>-->

                    <!-- Componente Create (Formulario) -->
                    <Create :categories="categories" @close="closeModal"></Create>
                </div>
            </div>
            <div v-if="showEditModal" class="modal-overlay">
                <div class="bg-white p-6 rounded shadow-lg w-1/2">
                    <!-- Aquí cargamos el componente Edit y le pasamos el producto a editar -->
                    <Edit :product="selectedProduct" @close="closeEditModal" />
                </div>
            </div>
        </div>

        <template #header>
            Productos
        </template>


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

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 50%;
    max-width: 600px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}
</style>
