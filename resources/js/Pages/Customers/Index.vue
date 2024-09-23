<script setup>
import {ref} from 'vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Props
const props = defineProps({
    customers: {type: Array}
});

// State for modals
const showCreateModal = ref(false);
const showEditModal = ref(false);
const showDeleteModal = ref(false);
const currentCustomer = ref(null);

// Form handling
const createForm = useForm({
    name: '',
    last_name: '',
    doc_type: '',
    dni: '',
    email: ''
});

const editForm = useForm({
    id: null,
    name: '',
    last_name: '',
    doc_type: '',
    dni: '',
    email: ''
});

// Methods
const openCreateModal = () => {
    createForm.reset();
    showCreateModal.value = true;
};

const openEditModal = (customer) => {
    editForm.id = customer.id;
    editForm.name = customer.name;
    editForm.last_name = customer.last_name;
    editForm.doc_type = customer.doc_type;
    editForm.dni = customer.dni;
    editForm.email = customer.email;
    showEditModal.value = true;
};

const openDeleteModal = (customer) => {
    currentCustomer.value = customer;
    showDeleteModal.value = true;
};

const createCustomer = () => {
    createForm.post(route('customers.store'), {
        onSuccess: () => {
            showCreateModal.value = false;
        }
    });
};

const updateCustomer = () => {
    editForm.put(route('customers.update', editForm.id), {
        onSuccess: () => {
            showEditModal.value = false;
        }
    });
};

const deleteCustomer = () => {
    router.delete(route('customers.destroy', currentCustomer.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
        }
    });
};
</script>

<template>
    <Head title="Clientes"/>

    <AuthenticatedLayout>
        <template #header>
            Clientes
        </template>

        <div class="p-4 bg-white rounded-lg shadow-xs">
            <button @click="openCreateModal" class="mb-4 px-4 py-2 bg-blue-500 text-white rounded float-right">
                Crear Cliente
            </button>

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
                    <tr v-for="(customer, i) in customers" :key="customer.id" class="text-gray-700">
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
                            <button @click="openEditModal(customer)">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>

                            </button>
                            <button @click="openDeleteModal(customer)">
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

        <!-- Create Modal -->
        <transition name="fade">
            <div v-if="showCreateModal"
                 class="fixed inset-0 flex items-center justify-center w-full h-full z-50 bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-2/5">
                    <h2 class="text-lg font-semibold mb-4">Crear Cliente</h2>
                    <form @submit.prevent="createCustomer">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input v-model="createForm.name" id="name" type="text"
                                   class="mt-1 block w-full border-2 border-red-500 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input v-model="createForm.last_name" id="last_name" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="doc_type" class="block text-sm font-medium text-gray-700">Tipo Doc.</label>
                            <input v-model="createForm.doc_type" id="doc_type" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="dni" class="block text-sm font-medium text-gray-700"># de Doc.</label>
                            <input v-model="createForm.dni" id="dni" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                            <input v-model="createForm.email" id="email" type="email"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="flex justify-end">
                            <button @click="showCreateModal = false" type="button"
                                    class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </transition>

        <!-- Edit Modal -->
        <transition name="fade">
            <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center w-full h-full z-50 bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-2/5">
                    <h2 class="text-lg font-semibold mb-4">Editar Cliente</h2>
                    <form @submit.prevent="updateCustomer">
                        <div class="mb-4">
                            <label for="edit_name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input v-model="editForm.name" id="edit_name" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Apellido</label>
                            <input v-model="editForm.last_name" id="edit_last_name" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_doc_type" class="block text-sm font-medium text-gray-700">Tipo Doc.</label>
                            <input v-model="editForm.doc_type" id="edit_doc_type" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_dni" class="block text-sm font-medium text-gray-700"># de Doc.</label>
                            <input v-model="editForm.dni" id="edit_dni" type="text"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                            <label for="edit_email" class="block text-sm font-medium text-gray-700">Correo</label>
                            <input v-model="editForm.email" id="edit_email" type="email"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="flex justify-end">
                            <button @click="showEditModal = false" type="button"
                                    class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </transition>

        <!-- Delete Modal -->
        <transition name="fade">
            <div v-if="showDeleteModal"
                 class="fixed inset-0 flex items-center justify-center w-full h-full z-50 bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-2/5">
                    <h2 class="text-lg font-semibold mb-4">Eliminar Cliente</h2>
                    <p>¿Estás seguro de que deseas eliminar a {{ currentCustomer.name }}?</p>
                    <div class="flex justify-end mt-4">
                        <button @click="showDeleteModal = false" type="button"
                                class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar
                        </button>
                        <button @click="deleteCustomer" type="button" class="px-4 py-2 bg-red-500 text-white rounded">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>

<style>
/* Transition styles for modals */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
