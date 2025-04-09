<template>
    <Head title="Farmers" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Farmers
                </h2>
                <Link
                    :href="route('farmers.create')"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300"
                >
                    Add New Farmer
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Street
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            City
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Zip Code
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-gray-200"
                                >
                                    <tr
                                        v-for="farmer in farmers.data"
                                        :key="farmer.farmer_id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ farmer.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ farmer.street }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ farmer.city }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ farmer.zip_code }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'farmers.edit',
                                                        farmer.farmer_id
                                                    )
                                                "
                                                class="text-green-600 hover:text-green-900 mr-3"
                                                >Edit</Link
                                            >
                                            <button
                                                @click="
                                                    deleteFarmer(
                                                        farmer.farmer_id
                                                    )
                                                "
                                                class="text-red-600 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Links -->
                        <div
                            class="mt-4"
                            v-if="farmers.links && farmers.links.length > 3"
                        >
                            <div class="flex justify-between">
                                <Link
                                    v-for="link in farmers.links"
                                    :key="link.label"
                                    :href="link.url"
                                    v-html="link.label"
                                    class="px-3 py-1 bg-white border rounded-md mx-1"
                                    :class="{ 'bg-green-50': link.active }"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    farmers: {
        type: Object,
        required: true,
    },
});

const deleteFarmer = (id) => {
    if (confirm("Are you sure you want to delete this farmer?")) {
        router.delete(route("farmers.destroy", id));
    }
};
</script>
