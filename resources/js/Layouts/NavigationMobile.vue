<template>
    <transition
        enter-active-class="transition ease-in-out duration-150"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in-out duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <div v-show="$page.props.showingMobileMenu"
             @click="closeMenu"
             class="fixed inset-0 z-10 flex items-end bg-gray-600 bg-opacity-50 sm:items-center sm:justify-center"></div>
    </transition>
    <transition
        enter-active-class="transition ease-in-out duration-150"
        enter-from-class="opacity-0 transform -translate-x-20"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in-out duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0 transform -translate-x-20">
        <aside v-show="$page.props.showingMobileMenu"
               class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden">
            <div class="py-4 text-gray-500">
                <Link class="ml-6 text-lg font-bold text-gray-800" :href="route('dashboard')">
                    POS
                </Link>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <template #icon>
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </template>
                            Inicio
                        </ResponsiveNavLink>
                    </li>
                    <li v-if="isAdmin || isCashier" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('cashier.index')" :active="route().current('cashier.index')">
                            <template #icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <title>cash-register</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M2,17H22V21H2V17M6.25,7H9V6H6V3H14V6H11V7H17.8C18.8,7 19.8,8 20,9L20.5,16H3.5L4.05,9C4.05,8 5.05,7 6.25,7M13,9V11H18V9H13M6,9V10H8V9H6M9,9V10H11V9H9M6,11V12H8V11H6M9,11V12H11V11H9M6,13V14H8V13H6M9,13V14H11V13H9M7,4V5H13V4H7Z"/>
                                </svg>
                            </template>
                            Caja
                        </ResponsiveNavLink>
                    </li>
                    <li v-if="isAdmin || isWaiter" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('orders.index')" :active="route().current('orders.index')">
                            <template #icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M9 8h6m-6 4h6m-6 4h6M6 3v18l2-2 2 2 2-2 2 2 2-2 2 2V3l-2 2-2-2-2 2-2-2-2 2-2-2Z"/>
                                </svg>
                            </template>
                            Ordenes
                        </ResponsiveNavLink>
                    </li>

                    <li v-if="isAdmin" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('products.index')" :active="route().current('products.index')">
                            <template #icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z"/>
                                </svg>
                            </template>
                            Productos
                        </ResponsiveNavLink>
                    </li>

                    <li v-if="isAdmin" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('customers.index')"
                                           :active="route().current('customers.index')">
                            <template #icon>
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="1"
                                          d="M9 8h6m-6 4h6m-6 4h6M6 3v18l2-2 2 2 2-2 2 2 2-2 2 2V3l-2 2-2-2-2 2-2-2-2 2-2-2Z"/>
                                </svg>
                            </template>
                            Clientes
                        </ResponsiveNavLink>
                    </li>

                    <li v-if="isAdmin" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('users.index')" :active="route().current('users.index')">
                            <template #icon>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </template>
                            Users
                        </ResponsiveNavLink>
                    </li>

                    <li v-if="user" class="relative px-6 py-3">
                        <ResponsiveNavLink :href="route('about')" :active="route().current('about')">
                            <template #icon>
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                                </svg>
                            </template>
                            About us
                        </ResponsiveNavLink>
                    </li>

                    <!--TODO ejemplo desplegable-->
                    <li v-if="false" class="relative px-6 py-3">
                        <button @click="showingTwoLevelMenu = !showingTwoLevelMenu"
                                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800"
                                aria-haspopup="true">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                <span class="ml-4">Two-level menu</span>
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul v-show="showingTwoLevelMenu"
                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50"
                            aria-label="submenu">
                            <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800">
                                <a class="w-full" href="#">Child menu</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
    </transition>
</template>

<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import {Link, usePage} from '@inertiajs/vue3';
import {computed, ref} from 'vue'

const page = usePage()

const user = computed(() => page.props.auth.user)
const roles = computed(() => page.props.auth.roles)
const isAdmin = computed(() => roles.value.includes('admin'))
const isWaiter = computed(() => roles.value.includes('waiter'))
const isCashier = computed(() => roles.value.includes('cashier'))
const isCustomer = computed(() => roles.value.includes('customer'))

const showingTwoLevelMenu = ref(false)

</script>
