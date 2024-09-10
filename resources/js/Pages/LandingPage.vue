<script setup>
import { Head, Link } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Inicio" />
    <v-app>
        <v-app-bar app color="primary" dark>
            <v-toolbar-title class="ml-10">DuvNic POS</v-toolbar-title>
            <v-spacer></v-spacer>
            <Link href="/login" class="btn btn-primary m">Iniciar sesión</Link>
            <Link href="/register" class="btn btn-secondary ml-2 mr-10">Registrarse</Link>
        </v-app-bar>

        <v-main>
            <v-container fluid fill-height>
                <v-row align="center" justify="center">
                    <v-col cols="12" md="6" class="text-center">
                        <v-img src="/path/to/your/image.jpg" height="300" contain class="mb-4"></v-img>
                        <v-card class="mx-auto" max-width="400">
                            <v-card-title>Bienvenido a Nuestra Aplicación</v-card-title>
                            <v-card-subtitle>
                                Sistema POS
                            </v-card-subtitle>
                            <v-card-actions>


                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>

        <v-footer app>
            <v-col class="text-center">
                © {{ new Date().getFullYear() }} DuvNic POS. Todos los derechos reservados.
            </v-col>
        </v-footer>
    </v-app>
</template>
