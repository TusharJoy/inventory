<template>
    <Head title="Shipments" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Shipments
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium">All Shipments</h3>
                            <Link
                                :href="route('shipments.create')"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Create New Shipment
                            </Link>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Order
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Warehouse
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Shipment Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Expected Delivery
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Tracking Number
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Carrier
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
                                        v-for="shipment in shipments"
                                        :key="shipment.shipment_id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Order #{{
                                                shipment.order.order_id
                                            }}
                                            - {{ shipment.order.customer.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{
                                                shipment.warehouse
                                                    .warehouse_name
                                            }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ shipment.shipment_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{
                                                shipment.expected_delivery_date
                                            }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="{
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                                                    'bg-yellow-100 text-yellow-800':
                                                        shipment.shipment_status ===
                                                        'pending',
                                                    'bg-blue-100 text-blue-800':
                                                        shipment.shipment_status ===
                                                        'in_transit',
                                                    'bg-green-100 text-green-800':
                                                        shipment.shipment_status ===
                                                        'delivered',
                                                    'bg-red-100 text-red-800':
                                                        shipment.shipment_status ===
                                                        'cancelled',
                                                }"
                                            >
                                                {{ shipment.shipment_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ shipment.tracking_number }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ shipment.carrier }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'shipments.edit',
                                                        shipment.shipment_id
                                                    )
                                                "
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="
                                                    deleteShipment(
                                                        shipment.shipment_id
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
    shipments: {
        type: Array,
        required: true,
    },
});

const deleteShipment = (shipmentId) => {
    if (confirm("Are you sure you want to delete this shipment?")) {
        router.delete(route("shipments.destroy", shipmentId));
    }
};
</script>
