<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ref} from "vue";


const showDeleteModal = ref(false);
const currentOrder = ref(null);

const props = defineProps({
    orders: {type: Array}
});

const openDeleteModal = (customer) => {
    currentOrder.value = customer;
    showDeleteModal.value = true;
};
</script>

<template>
    <Head title="Ordenes"/>

    <AuthenticatedLayout>
        <template #header>
            Ordenes
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">

            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 mb-3">
                <li class="me-2">
                    <a href="#" aria-current="page"
                       class="inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">
                        Hoy
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                        En preparación
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                        Por pagar
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
                        Todas
                    </a>
                </li>
            </ul>

            <button :href="route('orders.create.page')"
                    class="mb-4 px-4 py-2 bg-blue-500 text-white rounded float-right">
                Crear Nueva Orden
            </button>

            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3"># Orden</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Mesa</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Mesero</th>
                        <th class="px-4 py-3 flex justify-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="order in orders" class="text-gray-700">
                        <td class="px-4 py3 text-sm">
                            {{ order.order_number }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ order.customer.name ?? 'Consumidor final' }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ order.table }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.state }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ order.user.name ?? '' }}
                        </td>
                        <td class="px-4 py3 text-sm flex justify-center">
                            <button @click="openEditModal(order)">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>
                            </button>
                            <button @click="openDeleteModal(order)">
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
            </div>
        </div>

        <!-- Cancel Order -->
        <transition name="fade">
            <div v-if="showDeleteModal"
                 class="fixed inset-0 flex items-center justify-center w-full h-full z-50 bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-2/5">
                    <h2 class="text-lg font-semibold mb-4">Cancelar Orden</h2>
                    <p>¿Estás seguro de que deseas eliminar la orden número {{ currentOrder.order_number }}?</p>
                    <div class="flex justify-end mt-4">
                        <button @click="showDeleteModal = false" type="button"
                                class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar
                        </button>
                        <button @click="cancelOrder" type="button" class="px-4 py-2 bg-red-500 text-white rounded">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
