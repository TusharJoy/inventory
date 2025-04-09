<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium">All Orders</h3>
                            <Link
                                :href="route('orders.create')"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Create New Order
                            </Link>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Customer
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Market
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Order Date
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
                                            Total Amount
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Payment Status
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
                                        v-for="order in orders"
                                        :key="order.order_id"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ order.customer.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ order.market.market_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ order.order_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ order.expected_delivery_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="{
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                                                    'bg-yellow-100 text-yellow-800':
                                                        order.order_status ===
                                                        'pending',
                                                    'bg-blue-100 text-blue-800':
                                                        order.order_status ===
                                                        'processing',
                                                    'bg-green-100 text-green-800':
                                                        order.order_status ===
                                                        'shipped',
                                                    'bg-indigo-100 text-indigo-800':
                                                        order.order_status ===
                                                        'delivered',
                                                    'bg-red-100 text-red-800':
                                                        order.order_status ===
                                                        'cancelled',
                                                }"
                                            >
                                                {{ order.order_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            ${{ order.total_amount }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                :class="{
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                                                    'bg-yellow-100 text-yellow-800':
                                                        order.payment_status ===
                                                        'pending',
                                                    'bg-green-100 text-green-800':
                                                        order.payment_status ===
                                                        'paid',
                                                    'bg-blue-100 text-blue-800':
                                                        order.payment_status ===
                                                        'partially_paid',
                                                    'bg-red-100 text-red-800':
                                                        order.payment_status ===
                                                        'refunded',
                                                }"
                                            >
                                                {{ order.payment_status }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'orders.edit',
                                                        order.order_id
                                                    )
                                                "
                                                class="text-indigo-600 hover:text-indigo-900 mr-4"
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                @click="
                                                    deleteOrder(order.order_id)
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
    orders: {
        type: Array,
        required: true,
    },
});

const deleteOrder = (orderId) => {
    if (confirm("Are you sure you want to delete this order?")) {
        router.delete(route("orders.destroy", orderId));
    }
};
</script>
