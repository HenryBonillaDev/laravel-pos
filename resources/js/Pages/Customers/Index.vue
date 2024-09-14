<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps({
    customers: {type: Object}
});

</script>

<template>
    <Head title="Clientes"/>

    <AuthenticatedLayout>
        <template #header>
            Clientes
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Apellido</th>
                        <th class="px-4 py-3">Tipo Doc.</th>
                        <th class="px-4 py-3"># de Doc.</th>
                        <th class="px-4 py-3">Correo</th>
                        <th class="px-4 py-3 flex justify-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <tr v-for="(customer,i) in customers" :key="customer.id" class="text-gray-700">
                        <td class="px-4 py3 text-sm">
                            {{ (i + 1) }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.name }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.last_name }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.doc_type }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.dni }}
                        </td>
                        <td class="px-4 py3 text-sm">
                            {{ customer.email }}
                        </td>
                        <td class="px-4 py3 text-sm flex justify-center">
                            <button>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>

                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
