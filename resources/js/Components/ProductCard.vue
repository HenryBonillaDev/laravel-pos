<template>
    <div class="border p-4 rounded-lg shadow-lg flex flex-col justify-between">
        <img :src="product.imageUrl" alt="Imagen del producto" class="w-full h-40 object-cover mb-4 rounded" />
        <h3 class="text-xl font-bold mb-2">{{ product.name }}</h3>
        <p class="mb-4">${{ product.price }}</p>
        <button
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
            @click="addToOrder"
        >
            Añadir a la orden
        </button>
    </div>
</template>

<script setup>
const props = defineProps({
    product: Object,
});

const emit = defineEmits(['add-to-order']);

const addToOrder = () => {
    emit('add-to-order', props.product);
};
</script>

<style scoped>
/* Vuetify o Tailwind se pueden usar aquí para personalizar más */
</style>
