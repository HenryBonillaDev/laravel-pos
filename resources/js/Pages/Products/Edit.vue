<script setup>
import {defineEmits, reactive, toRefs, watch} from 'vue';
import {Head, useForm} from "@inertiajs/vue3";

// Props
const props = defineProps({
    product: {type: Object},// El producto que se va a editar
    categories: {type: Array}
});

const emit = defineEmits(['close']);

// Formulario reactivo
const editForm = useForm({
    id:'',
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
    editForm.id = newProduct.id;
    editForm.name = newProduct.name;
    editForm.stock = newProduct.stock;
    editForm.id_category = newProduct.id_category;
    editForm.price = newProduct.price;
    editForm.other_price = newProduct.other_price;
    editForm.sale_price = newProduct.sale_price;
    editForm.is_drink = newProduct.is_drink? 1:0;
}, { immediate: true });

// Método para actualizar el producto
const updateProduct = () => {
    console.log(editForm);
    editForm.put(route('products.update', editForm.id), {
        onSuccess: () => {
            emit('close');
        },
    });
};

const cancelar = () => {
    emit('close');
};
</script>

<template>
    <Head title="Editar Productos"/>

    <div>
        <h1 class="text-xl font-bold mb-4">Editar Producto</h1>
            <form @submit.prevent="updateProduct">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input v-model="editForm.name" id="name" type="text"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input v-model="editForm.stock" id="stock" type="number"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="id_category" class="block font-bold">Categoría</label>
                    <select v-model="editForm.id_category" id="id_category" class="border p-2 w-full" required>
                        <option value="" disabled>Seleccione una categoría</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input v-model="editForm.price" id="price" type="number"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="other_price" class="block text-sm font-medium text-gray-700">Otro precio</label>
                    <input v-model="editForm.other_price" id="other_price" type="number"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="sale_price" class="block text-sm font-medium text-gray-700">Precio de venta</label>
                    <input v-model="editForm.sale_price" id="sale_price" type="number"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="is_drink" class="block text-sm font-medium text-gray-700">¿Es bebida?</label>
                    <select v-model="editForm.is_drink" id="is_drink" class="shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2" required>
                        <option :value="null" disabled>Seleccione</option>
                        <option :value="1">Sí</option>
                        <option :value="0">No</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 rounded text-white px-4 py-2">Guardar</button>
                    <button @click="cancelar" type="button" class="bg-gray-500 rounded text-white px-4 py-2 ml-4">Cancelar</button>
                </div>
            </form>
        </div>
</template>

<style scoped>

</style>
