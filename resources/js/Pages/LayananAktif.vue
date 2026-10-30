<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';
const page = usePage();

const user = page.props.auth.user;

defineProps({
    ordera: Array,
    petugas: Array
})

const stat = ref([
  { id: 1, name: 'Sedang Dikerjakan' },
  { id: 3, name: 'Tunda' },
  { id: 2, name: 'Selesai' }
])

const inputPlaceholderUraian= ref('Isi Alasan Anda Disini');
const inputPlaceholderCatatan= ref('Isi Catatan Internal untuk Unit Disini');
const inputPlaceholderKomentar= ref('Isi Komentar Anda Disini');


const form = ref({
    idorder: '',
    status: 0,
    alasan: '',
    petugas: 0,
    catatan_internal: '',
    file_hasil: null
})

const handleFile = (event) =>
{
    form.value.file_hasil = event.target.files[0];
}

const isOpen = ref(false);
const selectedOrder = ref(null);


const OpenModal = (item) => {
    selectedOrder.value = item;
    form.value.idorder = item.idorder;
    form.value.status = item.status;
    form.value.petugas = item.petugas;
    isOpen.value = true;
}
const CloseModal = () => {
    isOpen.value = false;
    selectedOrder.value = null;
}

const loading = ref(false);
const submitOrderan = async() => {
    try {
        loading.value=true;
    
        const formOrderan = new formData();
        formOrderan.append('idorder', form.value.idorder)
        formOrderan.append('status', form.value.status)
        formOrderan.append('alasan', form.value.alasan)
        formOrderan.append('petugas', form.value.petugas)
        formOrderan.append('catatan_internal',form.value.catatan_internal)
        if (form.value.file_pdf) {
            formOrderan.append('file_hasil', form.value.file_hasil)
        }

        const resp = await axios.post('/order/editorderan', formOrderan, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })

        alert('Data sudah tersimpan.');

        form.value.idorder = ''
        form.value.status = 0
        form.value.alasan = ''
        form.value.petugas = 0
        form.value.catatan_internal = ''
        form.value.file_hasil = null
    } catch (err) {
        alert('Terjadi kesalahan saat mengajukan layanan.');
    } finally {
        loading.value = false;
    }
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white  shadow-sm sm:rounded-lg p-4">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Daftar Orderan Aktif</h2>
                    <div class="overflow-x-auto overflow-y-auto max-h-[600px]">
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
                                <tr v-for="items in ordera" :key="items.id" @click="OpenModal(items)" class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.idorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.tglorder }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.pemesan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_layanan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.nama_user }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ items.status === 1 ? 'Sedang Dikerjakan' : 'Belum' }}</td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <Modal :show="isOpen" @close="closeModal">
        <div class="p-10 w-full">
            <div class="justify-between flex flex-row">
                <h2 class="text-lg font-medium text-gray-900">
                    Detail Orderan {{ selectedOrder?.idorder }} - {{ selectedOrder?.pemesan}}
                </h2>
                <button 
                    @click="CloseModal" 
                    class=" font-medium"
                >
                X
                </button>
            </div>
            <div class="flex flex-row mt-2">
                    <div>
                        <iframe class="rounded-md"
                        :src="`/files/pdf-sample_0.pdf`" width="100%" height="700px" style="border: none">
                        </iframe>
                    </div>
                    <form @submit.prevent="submitForm">
                        <div class="bg-orange-200 rounded-md ml-5 p-4 flex flex-col">
                            <textarea  class="rounded-md mt-2"rows="4" max-rows="4" disabled>{{ selectedOrder?.keluhan }}</textarea>
                            <p class="font-semibold">Status</p>
                            <select v-model="form.status">
                                <option value="" disabled>{{ selectedOrder?.status === 1 ? 'Sedang Dikerjakan' : 'Belum' }}</option>
                                <option v-for="item in stat" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <textarea  class="rounded-md mt-2"rows="6" max-rows="6" :placeholder="inputPlaceholderUraian" v-model="form.alasan"></textarea>
                            <p class="font-semibold">Disposisi Petugas</p>
                            <select v-model="form.petugas">
                                <option v-for="item in petugas" :key="item.id" :value="item.id">
                                    {{ item.name }}
                                </option>
                            </select>
                            <p class="font-semibold">Komentar untuk Unit Disposisi</p>
                            <textarea  class="rounded-md mt-2"rows="2" max-rows="2" :placeholder="inputPlaceholderCatatan" v-model="form.catatan_internal"></textarea>
                            <p class="font-semibold">Hasil</p>
                            <input 
                                type="file" 
                                @change="handleFile" 
                                accept=".pdf"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-white-700 hover:file:bg-blue-500"
                            />
                            <a v-if="selectedOrder?.file_hasil !== ''" :href=" `/pdf/sop/${ selectedOrder?.idorder }_hasil.pdf`"> View File </a>
                            <button 
                                type="submit" 
                                :disabled="loading"
                                class="bg-blue-500 mt-2 text-white font-bold px-4 py-2 rounded hover:bg-blue-600 transition disabled:opacity-50"
                            >
                                {{ loading ? 'Tunggu...' : 'Ajukan' }}
                            </button>
                        </div>
                    </form>
               
            </div>
        </div>
    </Modal>
    </AuthenticatedLayout>
</template>