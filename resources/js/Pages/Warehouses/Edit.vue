<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    warehouse: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    street: props.warehouse.street,
    city: props.warehouse.city,
    zip_code: props.warehouse.zip_code,
    capacity: props.warehouse.capacity,
    storage_type: props.warehouse.storage_type,
});

const submit = () => {
    form.put(route("warehouses.update", props.warehouse.warehouse_id));
};
</script>

<template>
    <Head title="Edit Warehouse" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Warehouse
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="max-w-xl">
                            <div class="mb-4">
                                <InputLabel for="street" value="Street" />
                                <TextInput
                                    id="street"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.street"
                                    required
                                />
                                <InputError
                                    :message="form.errors.street"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="city" value="City" />
                                <TextInput
                                    id="city"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.city"
                                    required
                                />
                                <InputError
                                    :message="form.errors.city"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <InputLabel for="zip_code" value="Zip Code" />
                                <TextInput
                                    id="zip_code"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.zip_code"
                                    required
                                />
                                <InputError
                                    :message="form.errors.zip_code"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <InputLabel
                                    for="capacity"
                                    value="Capacity (in cubic meters)"
                                />
                                <TextInput
                                    id="capacity"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.capacity"
                                    required
                                />
                                <InputError
                                    :message="form.errors.capacity"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <InputLabel
                                    for="storage_type"
                                    value="Storage Type"
                                />
                                <select
                                    id="storage_type"
                                    class="mt-1 block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm"
                                    v-model="form.storage_type"
                                    required
                                >
                                    <option value="">
                                        Select a storage type
                                    </option>
                                    <option value="Cold Storage">
                                        Cold Storage
                                    </option>
                                    <option value="Dry Storage">
                                        Dry Storage
                                    </option>
                                    <option value="Controlled Atmosphere">
                                        Controlled Atmosphere
                                    </option>
                                    <option value="Frozen Storage">
                                        Frozen Storage
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.storage_type"
                                    class="mt-2"
                                />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Warehouse
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
