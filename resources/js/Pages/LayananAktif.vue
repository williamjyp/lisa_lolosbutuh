<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';
const page = usePage();

const user = page.props.auth.user;

defineProps({
    orders: Array
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white  shadow-sm sm:rounded-lg p-4">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Daftar Orderan Aktif</h2>
                    <div class="overflow-x-auto overflow-y">
                        <table class="min-w-full divide-y divide-gray-300 border">
                            <thead>
                            <tr>
                                <th>ID Orderan</th>
                                <th>Tanggal Meminta Layanan Informasi</th>
                                <th>Nama & Unit Peminta Layanan Informasi</th>
                                <th>Jenis Layanan</th>
                                <th>Petugas</th>
                                <th style="vertical-align:middle;" colspan="2">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="items in orders" :key="items.id" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.idorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.tglorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.pemesan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_layanan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_user }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.status === 1 ? 'Sedang Dikerjakan' : 'Belum' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{}}</td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

    </AuthenticatedLayout>
</template>