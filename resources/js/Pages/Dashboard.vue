<script setup>
import { defineProps } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';

const props = defineProps({
    users: {
        type: Array,

    }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="w-full table-auto">
                            <thead class="bg-gray-100">
                                <tr class="text-center">
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                           <tbody>
                            <tr v-for="(user,index) in props.users" :key="index" class="text-center hover:bg-gray-50 hover:cursor-pointer">
                                <td class="p-3">{{ user.id }}</td>
                                <td class="p-3">{{ user.name }}</td>
                                <td class="p-3">{{ user.email }}</td>
                                <td class="p-3">
                                    <Link :href="route('chat.index', user.id)" class="bg-green-400  hover:bg-green-600 hover:text-white p-2 rounded-2xl">
                                        Chat
                                    </Link>
                                </td>
                            </tr>
                           </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
