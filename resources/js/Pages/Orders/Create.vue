<template>
    <AuthenticatedLayout>
        <div class="flex flex-col lg:flex-row p-4">
            <!-- Tarjetas de productos -->
            <div class="w-full lg:w-2/3 grid grid-cols-2 gap-4">
                <ProductCard
                    v-for="product in filteredProducts"
                    :key="product.id"
                    :product="product"
                    @add-to-order="addItemToOrder"
                />
            </div>

            <!-- Carrito lateral para pantallas grandes -->
            <div class="hidden lg:block w-full lg:w-1/3 lg:pl-4 mt-4 lg:mt-0">
                <OrderSummary
                    :order-items="orderItems"
                    :total-price="totalPrice"
                    @remove-item="removeItemFromOrder"
                    @remove-all="removeAllOfItem"
                    @submit-order="submitOrder"
                />
            </div>

            <!-- Ventana flotante para pantallas pequeñas -->
            <div class="lg:hidden fixed bottom-4 right-4 z-50">
                <button
                    class="bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 transition"
                    @click="toggleOrderVisible"
                >
                    🛒
                </button>

                <!-- Ventana flotante de la orden -->
                <div
                    v-if="isOrderVisible"
                    class="fixed bottom-16 right-4 w-64 h-80 bg-white p-4 rounded-lg shadow-lg border overflow-y-auto transition-all"
                >
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold">Mi Orden</h2>
                        <button class="text-gray-500" @click="toggleOrderVisible">✖</button>
                    </div>

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
                                    @click="removeItemFromOrder(item)"
                                >
                                    -1
                                </button>
                                <button
                                    class="bg-red-700 text-white px-2 py-1 rounded hover:bg-red-800"
                                    @click="removeAllOfItem(item)"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </div>
                        <hr class="my-4"/>
                        <div class="flex justify-between text-lg font-bold">
                            <div>Total:</div>
                            <div>${{ totalPrice }}</div>
                        </div>

                        <!-- Botón de enviar orden -->
                        <button
                            class="bg-green-500 text-white w-full py-2 rounded mt-4 hover:bg-green-600"
                            @click="submitOrder"
                        >
                            Enviar Orden
                        </button>
                    </div>

                    <!-- Mensaje si no hay items -->
                    <div v-else class="text-gray-500">No hay items en la orden.</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {ref, computed, onMounted, watch} from 'vue';
import ProductCard from "@/Components/ProductCard.vue";
import OrderSummary from "@/Pages/Orders/OrderSummary.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

// Productos simulados (se puede reemplazar con una llamada a la API)
const products = ref([
    {id: 1, name: 'Producto A', price: 10, imageUrl: 'https://via.placeholder.com/150'},
    {id: 2, name: 'Producto B', price: 20, imageUrl: 'https://via.placeholder.com/150'},
    {id: 3, name: 'Producto C', price: 30, imageUrl: 'https://via.placeholder.com/150'},
]);

// Items de la orden
const orderItems = ref([]);

// Búsqueda
const searchQuery = ref('');

// Control de la visibilidad de la ventana flotante
const isOrderVisible = ref(false);

// Cargar orden desde cache si existe
const loadOrderFromCache = () => {
    const cachedOrder = localStorage.getItem('currentOrder');
    if (cachedOrder) {
        orderItems.value = JSON.parse(cachedOrder);
    }
};

// Guardar orden en cache
const saveOrderToCache = () => {
    localStorage.setItem('currentOrder', JSON.stringify(orderItems.value));
};

// Añadir item a la orden
const addItemToOrder = (product) => {
    const existingItem = orderItems.value.find(item => item.id === product.id);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        orderItems.value.push({...product, quantity: 1});
    }
    saveOrderToCache();
};

// Eliminar una unidad del producto en la orden
const removeItemFromOrder = (product) => {
    const existingItem = orderItems.value.find(item => item.id === product.id);
    if (existingItem) {
        existingItem.quantity--;
        if (existingItem.quantity === 0) {
            orderItems.value = orderItems.value.filter(item => item.id !== product.id);
        }
        saveOrderToCache();
    }
};

// Eliminar todos los items del mismo producto de la orden
const removeAllOfItem = (product) => {
    orderItems.value = orderItems.value.filter(item => item.id !== product.id);
    saveOrderToCache();
};

// Enviar la orden
const submitOrder = () => {
    alert('Orden enviada!');
    orderItems.value = [];
    saveOrderToCache();
};

// Filtrar productos según la búsqueda
const filteredProducts = computed(() => {
    if (!searchQuery.value) {
        return products.value;
    }
    return products.value.filter(product =>
        product.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

// Calcular precio total
const totalPrice = computed(() => {
    return orderItems.value.reduce((total, item) => total + item.price * item.quantity, 0);
});

// Mostrar u ocultar la orden
const toggleOrderVisible = () => {
    isOrderVisible.value = !isOrderVisible.value;
};

// Cargar la orden desde cache al montar el componente
onMounted(() => {
    loadOrderFromCache();
});

// Guardar cambios en cache cuando cambian los items
watch(orderItems, saveOrderToCache, {deep: true});

</script>

<style scoped>
/* Tailwind CSS integrado */
</style>
