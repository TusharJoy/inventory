<template>
    <Head title="Edit Batch" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Batch
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="
                                form.put(
                                    route('batches.update', batch.batch_id)
                                )
                            "
                            class="space-y-6"
                        >
                            <div>
                                <InputLabel for="farmer_id" value="Farmer" />
                                <select
                                    id="farmer_id"
                                    v-model="form.farmer_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="">Select a Farmer</option>
                                    <option
                                        v-for="farmer in farmers"
                                        :key="farmer.farmer_id"
                                        :value="farmer.farmer_id"
                                    >
                                        {{ farmer.name }}
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.farmer_id"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="batch_name"
                                    value="Batch Name"
                                />
                                <TextInput
                                    id="batch_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.batch_name"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.batch_name"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="start_date"
                                    value="Start Date"
                                />
                                <TextInput
                                    id="start_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.start_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.start_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="expected_end_date"
                                    value="Expected End Date"
                                />
                                <TextInput
                                    id="expected_end_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.expected_end_date"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.expected_end_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="actual_end_date"
                                    value="Actual End Date"
                                />
                                <TextInput
                                    id="actual_end_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.actual_end_date"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.actual_end_date"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="batch_status"
                                    value="Batch Status"
                                />
                                <select
                                    id="batch_status"
                                    v-model="form.batch_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="planned">Planned</option>
                                    <option value="in_progress">
                                        In Progress
                                    </option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.batch_status"
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
                                    :href="route('batches.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Batch
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
    batch: {
        type: Object,
        required: true,
    },
    farmers: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    farmer_id: props.batch.farmer_id,
    batch_name: props.batch.batch_name,
    start_date: props.batch.start_date,
    expected_end_date: props.batch.expected_end_date,
    actual_end_date: props.batch.actual_end_date,
    batch_status: props.batch.batch_status,
    notes: props.batch.notes,
});
</script>
