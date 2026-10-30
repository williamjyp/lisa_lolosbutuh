<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';
const page = usePage();

const user = page.props.auth.user;

defineProps({
    orderm: Array
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white  shadow-sm sm:rounded-lg p-4">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Daftar Orderan Sisi Mahasiswa</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 border">
                            <thead>
                            <tr>
                                <th class="border border-gray-300 px-2 py-1 text-left text-sm font-semibold text-gray-700">ID Orderan</th>
                                <th class="border border-gray-300 px-2 py-1 text-left text-sm font-semibold text-gray-700">Tanggal Meminta Layanan Informasi</th>
                                <th class="border border-gray-300 px-2 py-1 text-left text-sm font-semibold text-gray-700">Nama</th>
                                <th class="border border-gray-300 px-2 py-1 text-left text-sm font-semibold text-gray-700">Unit Peminta</th>
                                <th class="border border-gray-300 px-2 py-1 text-left text-sm font-semibold text-gray-700">Jenis Layanan</th>
                                <th style="vertical-align:middle;" colspan="2">Petugas & Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="items in orderm" :key="items.id" @click="OpenModal(items)" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.idorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.tglorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.pemesan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_layanan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_user }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.status === 1 ? 'Sedang Dikerjakan' : items.status === 2 ? 'Selesai' : items.status === 3 : 'Ditunda' ? 'Belum' }} <a v-if="items.status >= 2" href="/dashboard">View File Hasil</a></td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

    </AuthenticatedLayout>

</template>