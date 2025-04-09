<template>
    <Head title="Create Market" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Market
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form
                            @submit.prevent="form.post(route('markets.store'))"
                            class="space-y-6"
                        >
                            <div>
                                <InputLabel
                                    for="market_name"
                                    value="Market Name"
                                />
                                <TextInput
                                    id="market_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.market_name"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.market_name"
                                />
                            </div>

                            <div>
                                <InputLabel for="location" value="Location" />
                                <TextInput
                                    id="location"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.location"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.location"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="contact_person"
                                    value="Contact Person"
                                />
                                <TextInput
                                    id="contact_person"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.contact_person"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.contact_person"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="contact_number"
                                    value="Contact Number"
                                />
                                <TextInput
                                    id="contact_number"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.contact_number"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.contact_number"
                                />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div>
                                <InputLabel
                                    for="market_status"
                                    value="Market Status"
                                />
                                <select
                                    id="market_status"
                                    v-model="form.market_status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="temporary_closed">
                                        Temporarily Closed
                                    </option>
                                </select>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.market_status"
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
                                    :href="route('markets.index')"
                                    class="text-gray-600 hover:text-gray-900 mr-4"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Create Market
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

const form = useForm({
    market_name: "",
    location: "",
    contact_person: "",
    contact_number: "",
    email: "",
    market_status: "active",
    notes: "",
});
</script>
