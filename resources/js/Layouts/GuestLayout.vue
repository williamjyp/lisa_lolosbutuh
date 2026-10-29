<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-white-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div class="flex flex-col items-center bg-orange-300 sm:justify-center sm:pt-10 sm:pr-40 sm:pl-40 sm:pb-3 rounded-md">
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-orange-500" />
            </Link>
            
            <div class="items-center justify-center mt-3 text-white">
                Layanan Informasi 
            </div>
            <div class="items-center justify-center text-white">
                Satu Atap
            </div>
        </div>

        <div
            class="mt-2 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
