<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    farmer: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.farmer.name,
    street: props.farmer.street,
    city: props.farmer.city,
    zip_code: props.farmer.zip_code,
});

const submit = () => {
    form.put(route("farmers.update", props.farmer.farmer_id));
};
</script>

<template>
    <Head title="Edit Farmer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Farmer
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" class="max-w-xl">
                            <div class="mb-4">
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                />
                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>

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

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Farmer
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
