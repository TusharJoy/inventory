<template>
    <Head title="Create Shipment" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Shipment
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="
                                form.post(route('shipments.store'))
                            "
                            class="space-y-6"
                        >
                            <div>
                                <InputLabel for="order_id" value="Order" />
                                <select
                                    id="order_id"
                                    v-model="form.order_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select an Order</option>
                                    <option
                                        v-for="order in orders"
                                        :key="order.order_id"
                                        :value="order.order_id"
                                    >
                                        Order #{{ order.order_id }} -
                                        {{ order.customer.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.order_id"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="warehouse_id"
                                    value="Warehouse"
                                />
                                <select
                                    id="warehouse_id"
                                    v-model="form.warehouse_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select a Warehouse</option>
                                    <option
                                        v-for="warehouse in warehouses"
                                        :key="warehouse.warehouse_id"
                                        :value="warehouse.warehouse_id"
                                    >
                                        {{ warehouse.warehouse_name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.warehouse_id"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="shipment_date"
                                    value="Shipment Date"
                                />
                                <TextInput
                                    id="shipment_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.shipment_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.shipment_date"
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
                                    for="shipment_status"
                                    value="Shipment Status"
                                />
                                <select
                                    id="shipment_status"
                                    v-model="form.shipment_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="pending">Pending</option>
                                    <option value="in_transit">
                                        In Transit
                                    </option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.shipment_status"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="tracking_number"
                                    value="Tracking Number"
                                />
                                <TextInput
                                    id="tracking_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tracking_number"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.tracking_number"
                                />
                            </div>

                            <div>
                                <InputLabel for="carrier" value="Carrier" />
                                <TextInput
                                    id="carrier"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.carrier"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.carrier"
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
                                    :href="route('shipments.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create Shipment
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
    orders: {
        type: Array,
        required: true,
    },
    warehouses: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    order_id: "",
    warehouse_id: "",
    shipment_date: "",
    expected_delivery_date: "",
    shipment_status: "pending",
    tracking_number: "",
    carrier: "",
    notes: "",
});
</script>
