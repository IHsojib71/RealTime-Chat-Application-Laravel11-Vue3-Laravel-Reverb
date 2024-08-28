<script setup>
import { defineProps } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import ChatComponent from '@/Components/ChatComponent.vue';
const props = defineProps({
    friend: {
        type: Object,

    }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ props.friend.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ChatComponent :friend="props.friend"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
