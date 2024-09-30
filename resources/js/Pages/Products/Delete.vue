<script setup>
import {defineEmits, reactive, toRefs, watch} from 'vue';
import {Head, router, useForm} from "@inertiajs/vue3";

// Props
const props = defineProps({
    product: {type: Object},// El producto que se va a editar
});

const emit = defineEmits(['close']);
const productToDelete = props.product;
const deleteProduct = () => {
    router.delete(route('products.destroy', productToDelete.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
        }
    });
};

const cancelar = () => {
    emit('close');
};
</script>

<template>
            <h2 class="text-lg font-semibold mb-4">Eliminar Producto</h2>
            <p>¿Estás seguro de que deseas eliminar el producto {{ product.name }}?</p>
            <div class="flex justify-end mt-4">
                <button @click="cancelar" type="button" class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar</button>
                <button @click="deleteProduct" type="button" class="px-4 py-2 bg-red-500 text-white rounded">
                    Eliminar
                </button>
            </div>
</template>

<style scoped>

</style>
