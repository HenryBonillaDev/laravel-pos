<script setup>
import { reactive, toRefs, watch } from 'vue';
import {Head} from "@inertiajs/vue3";

// Props
const props = defineProps({
    product: Object, // El producto que se va a editar
});

// Formulario reactivo
const editForm = reactive({
    name: '',
    stock: '',
    id_category: '',
    price: '',
    other_price: '0',
    sale_price: '0',
    is_drink: '',
    state: 'A'

});

// Llenar el formulario cuando el producto cambie
watch(() => props.product, (newProduct) => {
    editForm.name = newProduct.name;
    editForm.stock = newProduct.stock;
    // otros campos...
}, { immediate: true });

// Método para actualizar el producto
const updateProduct = () => {
    // Aquí iría la lógica para actualizar el producto, como una petición a una API
    console.log('Producto actualizado', editForm);
    // Emitir un evento de cierre (opcional)
    emit('close');
};
</script>

<template>
    <Head title="Crear Productos"/>

    <div>
        <h1 class="text-xl font-bold mb-4">Editar Producto</h1>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input v-model="editForm.name" id="edit_name" type="text"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input v-model="editForm.stock" id="edit_last_name" type="text"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_doc_type" class="block text-sm font-medium text-gray-700">Tipo Doc.</label>
                    <input v-model="editForm.id_category" id="edit_doc_type" type="text"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_dni" class="block text-sm font-medium text-gray-700"># de Doc.</label>
                    <input v-model="editForm.price" id="edit_dni" type="text"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input v-model="editForm.other_price" id="edit_email" type="email"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input v-model="editForm.sale_price" id="edit_email" type="email"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="edit_email" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input v-model="editForm.is_drink" id="edit_email" type="email"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 rounded text-white px-4 py-2">Guardar Producto</button>
                    <button @click="cancelar" type="button" class="bg-gray-500 rounded text-white px-4 py-2 ml-4">Cancelar</button>
                </div>
            </form>
        </div>
</template>

<style scoped>

</style>
