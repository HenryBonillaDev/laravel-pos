<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    categories: {type: Array}
});


// Definir emisor de eventos
const emit = defineEmits(['close']);

// Formulario reactivo
const form = useForm({
    name: '',
    stock: '',
    id_category: '',
    price: '',
    other_price: '0',
    sale_price: '0',
    is_drink: '',
    state: 'A'
});

// Método para manejar el envío del formulario
const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            emit('close'); // Emitir el evento para cerrar el modal
        },
    });
};

// Método para cancelar y cerrar el modal
const cancelar = () => {
    emit('close'); // Emitir el evento para cerrar el modal al cancelar
};
</script>

<template>
    <Head title="Crear Productos"/>

        <div>
            <h1 class="text-xl font-bold mb-4">Agregar Producto</h1>

            <form @submit.prevent="submit">
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre del producto</label>
                    <input v-model="form.name" id="name" type="text" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                    <span v-if="form.errors.name" class="text-red-600">{{ form.errors.name }}</span>
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input v-model="form.stock" id="stock" type="number" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                    <span v-if="form.errors.stock" class="text-red-600">{{ form.errors.stock }}</span>
                </div>

                <!-- Categoria -->
                <div class="mb-4">
                    <label for="id_category" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select v-model="form.id_category" id="id_category" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                        <option value="" disabled>Seleccione una categoría</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                    <span v-if="form.errors.id_category" class="text-red-600">{{ form.errors.id_category }}</span>
                </div>

                <!-- Precio -->
                <div class="mb-4">
                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input v-model="form.price" id="precio" type="number" step="0.01" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                    <span v-if="form.errors.price" class="text-red-600">{{ form.errors.precio }}</span>
                </div>

                <!-- Is Drink -->
                <div class="mb-4">
                    <label for="is_drink" class="block text-sm font-medium text-gray-700">¿Es bebida?</label>
                    <select v-model="form.is_drink" id="is_drink" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                        <option value="" disabled>Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                    <span v-if="form.errors.is_drink" class="text-red-600">{{ form.errors.is_drink }}</span>
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 rounded text-white px-4 py-2">Guardar Producto</button>
                    <button @click="cancelar" type="button" class="bg-gray-500 rounded text-white px-4 py-2 ml-4">Cancelar</button>
                </div>
            </form>
        </div>
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
