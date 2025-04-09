<template>
    <Head title="Create Order" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Order
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="form.post(route('orders.store'))"
                            class="space-y-6"
                        >
                            <div>
                                <InputLabel
                                    for="customer_id"
                                    value="Customer"
                                />
                                <select
                                    id="customer_id"
                                    v-model="form.customer_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select a Customer</option>
                                    <option
                                        v-for="customer in customers"
                                        :key="customer.customer_id"
                                        :value="customer.customer_id"
                                    >
                                        {{ customer.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.customer_id"
                                />
                            </div>

                            <div>
                                <InputLabel for="market_id" value="Market" />
                                <select
                                    id="market_id"
                                    v-model="form.market_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select a Market</option>
                                    <option
                                        v-for="market in markets"
                                        :key="market.market_id"
                                        :value="market.market_id"
                                    >
                                        {{ market.market_name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.market_id"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="order_date"
                                    value="Order Date"
                                />
                                <TextInput
                                    id="order_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.order_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.order_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="expected_delivery_date"
                                    value="Expected Delivery Date"
                                />
                                <TextInput
                                    id="expected_delivery_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.expected_delivery_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="
                                        form.errors.expected_delivery_date
                                    "
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="order_status"
                                    value="Order Status"
                                />
                                <select
                                    id="order_status"
                                    v-model="form.order_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="pending">Pending</option>
                                    <option value="processing">
                                        Processing
                                    </option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.order_status"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="total_amount"
                                    value="Total Amount"
                                />
                                <TextInput
                                    id="total_amount"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.total_amount"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.total_amount"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="payment_status"
                                    value="Payment Status"
                                />
                                <select
                                    id="payment_status"
                                    v-model="form.payment_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="partially_paid">
                                        Partially Paid
                                    </option>
                                    <option value="refunded">Refunded</option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.payment_status"
                                />
                            </div>

                            <div>
                                <InputLabel for="notes" value="Notes" />
                                <textarea
                                    id="notes"
                                    v-model="form.notes"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3"
                                ></textarea>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.notes"
                                />
                            </div>

                            <div class="flex items-center justify-end">
                                <Link
                                    :href="route('orders.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create Order
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    customers: {
        type: Array,
        required: true,
    },
    markets: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    customer_id: "",
    market_id: "",
    order_date: "",
    expected_delivery_date: "",
    order_status: "pending",
    total_amount: "",
    payment_status: "pending",
    notes: "",
});
</script>
