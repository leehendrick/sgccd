<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TableButton from "@/Components/TableButton.vue";
import Pagination from "@/Components/Pagination.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import { computed, ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Switch, SwitchGroup, SwitchLabel } from "@headlessui/vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    values: Object,
    filters: Object,
});

const display = ref(false);
const showForm = ref(false);
const search = ref(props.filters.search);
const idSelected = ref("");
const modalData = ref({});

watch(search, (value) => {
    router.get(
        "/cursos",
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const close = () => {
    display.value = false;
};

const itemEncontrado = computed(() => {
    for (const chave in props.values.data) {
        // Verificar se a chave é um ID e se corresponde ao ID procurado
        if (props.values.data[chave].id === idSelected.value) {
            return props.values.data[chave];
        }
    }
    return null;
});

const showMore = (value, id) => {
    display.value = value;
    idSelected.value = id;
    modalData.value = itemEncontrado.value;
    console.log(modalData.value);
};

const addCurso = () => {
    showForm.value = true;
};

const agreed = ref(false);
</script>

<template>
    <admin-layout>
        <div class="px-4 sm:px-6 lg:px-8 mt-10">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">
                        Cursos
                    </h1>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <primary-button @click="addCurso" type="button"
                        >Add curso</primary-button
                    >
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search..."
                        class="focus:border-secondary focus:ring-secondary rounded-md shadow-sm"
                    />
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                    >
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th
                                        scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                                    >
                                        Nome
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Vagas
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Duração
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        class="relative py-3.5 pl-3 pr-4 sm:pr-0"
                                    >
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="curso in values.data" :id="curso.id">
                                    <td
                                        class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0"
                                    >
                                        <div class="flex items-center">
                                            <div class="">
                                                <div
                                                    class="font-medium text-gray-900"
                                                >
                                                    {{ curso.nome }}
                                                </div>
                                                <div
                                                    class="mt-1 text-gray-500"
                                                ></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-5 text-sm text-gray-500"
                                    >
                                        <div class="text-gray-900">
                                            {{ curso.vagas }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-5 text-sm text-gray-500"
                                    >
                                        <div class="mt-1 text-gray-500">
                                            {{ curso.duracao }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-5 text-sm text-gray-500"
                                    >
                                        <span
                                            class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium"
                                            :class="
                                                curso.status === 'aberto'
                                                    ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20'
                                                    : 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20'
                                            "
                                            >{{ curso.status }}</span
                                        >
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap px-5 py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                    >
                                        <div>
                                            <TableButton
                                                @click="
                                                    showMore(true, curso.id)
                                                "
                                                status="ver"
                                            />
                                            <TableButton status="delete" />
                                            <TableButton status="edit" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Paginator -->
        <Pagination :links="values.links" class="mt-6" />
        <Modal :show="display">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Dados do Curso
                </h2>
                <div class="mt-2 text-xl bold border-t border-gray-900/10">
                    <p class="mt-2 text-sm text-gray-900">
                        <strong>Nome : </strong>
                        {{ modalData.nome }}
                    </p>
                    <p
                        class="mt-2 text-sm pt-2 text-gray-900 border-t border-gray-900/10"
                    >
                        <strong>Data de Inicio :</strong>
                        {{ modalData.data_inicio }}
                    </p>
                    <p
                        class="mt-2 text-sm pt-2 text-gray-900 border-t border-gray-900/10"
                    >
                        <strong>Data de Término :</strong>
                        {{ modalData.data_termino }}
                    </p>
                    <p
                        class="mt-2 text-sm pt-2 text-gray-900 border-t border-gray-900/10"
                    >
                        <strong>Vagas :</strong>
                        {{ modalData.vagas }}
                    </p>
                    <p
                        class="mt-2 text-sm pt-2 text-gray-900 border-t border-gray-900/10"
                    >
                        <strong>Status :</strong>
                        {{ modalData.status }}
                    </p>
                    <p
                        class="mt-1 text-sm pt-2 text-gray-900 border-t border-gray-900/10"
                    >
                        <strong>Duração :</strong>
                        {{ modalData.duracao }}
                    </p>
                </div>
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="close"> Cancel </SecondaryButton>
                </div>
            </div>
        </Modal>
        <Modal :show="showForm">
            <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Nome do curso</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Descrição</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Duração</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Preço</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Data de início</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Data de término</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Local</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Vagas</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Requisitos</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="last-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Status</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="last-name"
                                id="last-name"
                                autocomplete="family-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="first-name"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Categoria</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="first-name"
                                id="first-name"
                                autocomplete="given-name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
                <div class="m-5 flex justify-end">
                    <SecondaryButton class="mx-2"> Adicionar </SecondaryButton>
                    <SecondaryButton class="bg-red-600">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Modal>
    </admin-layout>
</template>

<style scoped></style>
