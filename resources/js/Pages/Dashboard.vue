<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Modal from '@/Components/Modal.vue';
import axios from 'axios';
const page = usePage();

const user = page.props.auth.user;

interface jmlOrderan {
   aktif: number,
   tunda: number,
   selesai: number
}

const jmlOrderan = ref<jmlOrderan>({
    aktif: 0,
    tunda: 0,
    selesai: 0
}) 

const form = ref({
    idlayanan: 0,
    keluhan: '',
    pemesan: '',
    unit: '',
    petugas: 0,
    file_pdf: null
})

const handleFile = (event) =>
{
    form.value.file_pdf = event.target.files[0];
}
const loading = ref(false);
const submitOrderan = async() => {
    try {
        loading.value=true;
    
        const formOrderan = new formOrderan();
        formOrderan.append('idlayanan', form.value.idlayanan)
        formOrderan.append('keluhan', form.value.keluhan)
        formOrderan.append('pemesan', form.value.pemesan)
        formOrderan.append('unit', form.value.unit)
        formOrderan.append('petugas', form.value.petugas)
        if (form.value.file_pdf) {
            formOrderan.append('file_pdf', form.value.file_pdf)
        }

        const resp = await axios.post('/order/simpanorderan', formOrderan, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })

        alert('Data sudah tersimpan.');

        form.value.idlayanan = ''
        form.value.keluhan = ''
        form.value.petugas = 0
        form.value.file_pdf = null
    } catch (err) {
        alert('Terjadi kesalahan saat mengajukan layanan.');
    } finally {
        loading.value = false
    }
}



const jenisLayanan = ref([]);

const isOpen = ref(false);
const selectedLayanan = ref(null);

const inputPlaceholderUraian= ref('Isi Uraian Anda Disini');
const OpenModal = (item) => {
    selectedLayanan.value = item;
    form.value.petugas = item.iduser;
    form.value.idlayanan = item.idlayanan;
    form.value.pemesan = user.name;
    form.value.unit = user.email;
    isOpen.value = true;
}

const CloseModal = () => {
    isOpen.value = false;
    selectedLayanan.value = null;
}
const fetchJumlahOrderan = async () => {
    const resp = await axios.get('/order/getjmlo');
    jmlOrderan.value = resp.data;
}
const fetchJenisLayanan = async () => {
    const resp = await axios.get('/jenislayanan/getjenislayanan');
    jenisLayanan.value = resp.data;

}
onMounted(() => {
  fetchJumlahOrderan();
  fetchJenisLayanan();
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template> -->

       <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white  shadow-sm sm:rounded-lg p-4"
                >
                  
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full">
                        <div class="bg-blue-500 sm:justify-center sm:px-5 rounded-md">
                            <div class="items-center justify-center mt-3 text-white">
                                Layanan Informasi Aktif
                            </div>
                            <hr class="my-2 h-0.5 border-t-0 bg-neutral-100" />
                            <div class="items-center justify-center sm:mb-3 text-white font-semibold">
                                {{ jmlOrderan.aktif }}
                            </div>
                        </div>
                        <div class="bg-red-500 sm:justify-center sm:px-5 rounded-md">
                            <div class="items-center justify-center mt-3 text-white">
                                Layanan Informasi Ditunda
                            </div>
                            <hr class="my-2 h-0.5 border-t-0 bg-neutral-100" />
                            <div class="items-center justify-center sm:mb-3 text-white font-semibold">
                                {{ jmlOrderan.tunda }}
                            </div>
                        </div>
                        <div class="bg-green-500 sm:justify-center sm:px-5 rounded-md">
                            <div class="items-center justify-center sm:mt-3 text-white">
                                Layanan Informasi Selesai
                            </div>
                            <hr class="my-2 h-0.5 border-t-0 bg-neutral-100" />
                            <div class="items-center justify-center sm:mb-3 text-white font-semibold">
                                {{ jmlOrderan.selesai }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-0">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white mb-2 shadow-sm sm:rounded-lg items-center justify-center font-semibold pl-4">
                Pilih Layanan Informasi yang Dituju
            </div>
                <div
                    class="overflow-hidden overflow-y-auto  max-h-[650px] bg-white shadow-sm sm:rounded-lg p-4"
                >
                    <div class="grid grid-cols-5 sm:grid-cols-3 gap-4 w-full">
                        <div v-for="items in jenisLayanan" class="bg-orange-300 sm:justify-center sm:px-5 rounded-md">
                            <div class="items-center justify-center sm:mt-3 text-blue-600 font-semibold">
                                {{ items.namalayanan }}
                            </div>
                            <hr class="my-2 h-0.5 border-t-0 bg-neutral-900" />
                            <div class="items-center justify-center sm:mb-3 text-white">
                                <button @click="OpenModal(items)" class="bg-blue-600 font-semibold px-4 py-1.5 rounded hover:bg-blue-500  transitions">
                                    Masuk
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="isOpen" @close="closeModal">
            <div class="p-10 w-full">
                <div class="justify-between flex flex-row">
                <h2 class="text-lg font-medium text-gray-900">
                    Detail {{ selectedLayanan?.namalayanan }}
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
                        :src="`/pdf/sop/${ selectedLayanan?.namalayanan }.pdf`" width="100%" height="700px" style="border: none">
                        </iframe>
                    </div>
                    <form @submit.prevent="submitForm">
                    <div class="bg-orange-200 rounded-md ml-5 p-4 flex flex-col">
                        <p class="font-semibold">Silahkan masukkan informasi</p>
                        <textarea  class="rounded-md mt-2"rows="12" max-rows="12" :placeholder="inputPlaceholderUraian" v-model="form.keluhan"></textarea>
                        <p class="font-semibold">Petugas</p>
                        <input type="text" class="mt-2 rounded-md" :value="`${ selectedLayanan?.nama_user }`" disabled></input>
                        <input type="text" v-model="form.petugas" hidden></input>
                        <input type="text" v-model="form.idlayanan" hidden></input>
                        <p class="font-semibold">Atas Nama</p>
                        <input type="text" class="mt-2 rounded-md" v-model="form.pemesan" disabled></input>
                        <input type="text" class="mt-2 rounded-md" v-model="form.unit" disabled></input>
                        <p class="font-semibold">File</p>
                        <input 
                            type="file" 
                            @change="handleFile" 
                            accept=".pdf"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-white-700 hover:file:bg-blue-500"
                        />
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
