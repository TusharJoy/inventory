<template>
    <Head title="Create Crop" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Crop
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="form.post(route('crops.store'))"
                            class="space-y-6"
                        >
                            <div>
                                <InputLabel for="batch_id" value="Batch" />
                                <select
                                    id="batch_id"
                                    v-model="form.batch_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select a Batch</option>
                                    <option
                                        v-for="batch in batches"
                                        :key="batch.batch_id"
                                        :value="batch.batch_id"
                                    >
                                        {{ batch.batch_name }} ({{
                                            batch.farmer.name
                                        }})
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.batch_id"
                                />
                            </div>

                            <div>
                                <InputLabel for="crop_name" value="Crop Name" />
                                <TextInput
                                    id="crop_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.crop_name"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.crop_name"
                                />
                            </div>

                            <div>
                                <InputLabel for="crop_type" value="Crop Type" />
                                <TextInput
                                    id="crop_type"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.crop_type"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.crop_type"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="crop_variety"
                                    value="Crop Variety"
                                />
                                <TextInput
                                    id="crop_variety"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.crop_variety"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.crop_variety"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="growing_season"
                                    value="Growing Season"
                                />
                                <TextInput
                                    id="growing_season"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.growing_season"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.growing_season"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="planting_date"
                                    value="Planting Date"
                                />
                                <TextInput
                                    id="planting_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.planting_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.planting_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="expected_harvest_date"
                                    value="Expected Harvest Date"
                                />
                                <TextInput
                                    id="expected_harvest_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.expected_harvest_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.expected_harvest_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="actual_harvest_date"
                                    value="Actual Harvest Date"
                                />
                                <TextInput
                                    id="actual_harvest_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.actual_harvest_date"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.actual_harvest_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="yield_amount"
                                    value="Yield Amount"
                                />
                                <TextInput
                                    id="yield_amount"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.yield_amount"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.yield_amount"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="yield_unit"
                                    value="Yield Unit"
                                />
                                <TextInput
                                    id="yield_unit"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.yield_unit"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.yield_unit"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="crop_status"
                                    value="Crop Status"
                                />
                                <select
                                    id="crop_status"
                                    v-model="form.crop_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="planted">Planted</option>
                                    <option value="growing">Growing</option>
                                    <option value="ready_for_harvest">
                                        Ready for Harvest
                                    </option>
                                    <option value="harvested">Harvested</option>
                                    <option value="failed">Failed</option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.crop_status"
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
                                    :href="route('crops.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create Crop
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
    batches: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    batch_id: "",
    crop_name: "",
    crop_type: "",
    crop_variety: "",
    growing_season: "",
    planting_date: "",
    expected_harvest_date: "",
    actual_harvest_date: "",
    yield_amount: "",
    yield_unit: "",
    crop_status: "planted",
    notes: "",
});
</script>
