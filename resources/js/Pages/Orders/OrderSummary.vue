<template>
    <div class="border p-4 rounded-lg shadow">
        <h2 class="text-lg font-bold mb-4">Mi Orden</h2>

        <!-- Lista de items -->
        <div v-if="orderItems.length > 0">
            <div v-for="(item, index) in orderItems" :key="index" class="mb-4">
                <div class="flex justify-between">
                    <div>{{ item.name }} (x{{ item.quantity }})</div>
                    <div>${{ item.price * item.quantity }}</div>
                </div>
                <div class="flex justify-end space-x-2 mt-1">
                    <button
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                        @click="$emit('remove-item', item)"
                    >
                        -1
                    </button>
                    <button
                        class="bg-red-700 text-white px-2 py-1 rounded hover:bg-red-800"
                        @click="$emit('remove-all', item)"
                    >
                        Eliminar
                    </button>
                </div>
            </div>
            <hr class="my-4" />
            <div class="flex justify-between text-lg font-bold">
                <div>Total:</div>
                <div>${{ totalPrice }}</div>
            </div>

            <!-- Botón de enviar orden -->
            <button
                class="bg-green-500 text-white w-full py-2 rounded mt-4 hover:bg-green-600"
                @click="$emit('submit-order')"
            >
                Enviar Orden
            </button>
        </div>

        <!-- Mensaje si no hay items -->
        <div v-else class="text-gray-500">No hay items en la orden.</div>
    </div>
</template>

<script setup>
defineProps({
    orderItems: Array,
    totalPrice: Number,
});
</script>

<style scoped>
/* Tailwind CSS */
</style>
