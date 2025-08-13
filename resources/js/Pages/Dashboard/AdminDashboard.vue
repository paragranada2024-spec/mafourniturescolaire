<script setup>
import LayoutAdmin from "@/Layout/LayoutAdmin.vue";
import { usePage, router, Head, Link } from "@inertiajs/vue3";
defineOptions({
    layout: LayoutAdmin,
});

</script>

<template>
    <div class="">
        <Head title="Admin Dashboard" />
        <template>
            <div class="flex items-center justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Admin Dashboard
                </h2>

                <Link
                    href="/client-dashboard"
                    class="text-sm text-blue-600 hover:underline dark:text-blue-400"
                >
                    Aller au dashboard client
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        You're logged in as an admin!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
