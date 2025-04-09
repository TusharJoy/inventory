<template>
    <Head title="Crops" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Crops
                </h2>
                <Link
                    :href="route('crops.create')"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300"
                >
                    Add New Crop
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
                                            Crop Name
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Type
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Variety
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Status
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
                                        v-for="crop in crops.data"
                                        :key="crop.crop_id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ crop.crop_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ crop.crop_type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ crop.crop_variety }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="
                                                    getStatusClass(
                                                        crop.crop_status
                                                    )
                                                "
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            >
                                                {{ crop.crop_status }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'crops.edit',
                                                        crop.crop_id
                                                    )
                                                "
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                >Edit</Link
                                            >
                                            <button
                                                @click="
                                                    deleteCrop(crop.crop_id)
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
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <template
                                    v-for="link in crops.links"
                                    :key="link.label"
                                >
                                    <Link
                                        v-if="link.url"
                                        :href="link.url"
                                        v-html="link.label"
                                        class="px-3 py-1 bg-white border rounded-md mx-1"
                                        :class="{ 'bg-green-50': link.active }"
                                    />
                                    <span
                                        v-else
                                        v-html="link.label"
                                        class="px-3 py-1 bg-gray-100 border rounded-md mx-1 text-gray-400"
                                    />
                                </template>
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
import { router } from "@inertiajs/vue3";

const props = defineProps({
    crops: {
        type: Object,
        required: true,
    },
});

const getStatusClass = (status) => {
    const classes = {
        planted: "bg-blue-100 text-blue-800",
        growing: "bg-yellow-100 text-yellow-800",
        ready_for_harvest: "bg-purple-100 text-purple-800",
        harvested: "bg-green-100 text-green-800",
        failed: "bg-red-100 text-red-800",
    };
    return classes[status] || "bg-gray-100 text-gray-800";
};

const deleteCrop = (id) => {
    if (confirm("Are you sure you want to delete this crop?")) {
        router.delete(route("crops.destroy", id));
    }
};
</script>
