<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import Pagination from "@/Components/Pagination.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TableButton from "@/Components/TableButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { onMounted, ref } from "vue";
import Swal from "sweetalert2";
import { useForm, router } from "@inertiajs/vue3";

const Props = defineProps({
    values: Object,
    filters: Object,
    cursos: Object,
    horarios: Object,
    instrutor: Object,
});

const search = ref(Props.filters.search);

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

const form = useForm({
    nome: "",
    data_inicio: null,
    data_termino: null,
    local: "",
    status: null,
    descricao: "",
    curso_id: null,
    instrutor_id: null,
    horario_id: null,
});
const showForm = ref(false);

const addTurma = () => {
    showForm.value = true;
};

const nomeRegex = /^[A-Za-zÀ-ú\s]{5,}$/;
const idRegex = /^\d+$/;
const validateNome = () => {
    form.errors.nome = nomeRegex.test(form.nome) ? "" : "Nome inválido";
};
const validateLocal = () => {
    form.errors.local = nomeRegex.test(form.local) ? "" : "Local inválido";
};
const validateDescricao = () => {
    form.errors.descricao = nomeRegex.test(form.descricao)
        ? ""
        : "Descrição inválido";
};
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
                    <primary-button type="button" @click="addTurma"
                        >Add turma</primary-button
                    >
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <input
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
                                        Data de Início
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    >
                                        Data de Término
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
                                            {{ curso.data_inicio }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-5 text-sm text-gray-500"
                                    >
                                        <div class="mt-1 text-gray-500">
                                            {{ curso.data_termino }}
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-3 py-5 text-sm text-gray-500"
                                    >
                                        <span
                                            class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium"
                                            :class="
                                                curso.status === 'Disponível'
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
                                            <TableButton status="ver" />
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
        <Modal :show="showForm">
            <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <input-label
                            for="nome"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Nome da turma</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="nome"
                                id="nome"
                                v-model="form.nome"
                                autocomplete="given-name"
                                @input="validateNome"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.nome"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="local"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Local</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="local"
                                id="local"
                                v-model="form.local"
                                @input="validateLocal"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.local"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="data_inicio"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Data de ínicio</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="date"
                                name="data_inicio"
                                id="data_inicio"
                                v-model="form.data_inicio"
                                @input="validateDataInicio"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.data_inicio"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="data_termino"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Data de término</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="date"
                                name="data_termino"
                                id="data_termino"
                                v-model="form.data_termino"
                                @input="validateDataTermino"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.data_termino"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="descricao"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Descrição</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="descricao"
                                id="descricao"
                                v-model="form.descricao"
                                @input="validateDescricao"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.descricao"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="status"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Status</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="statuSelect"
                                @change="form.status = statuSelect"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Disponível</option>
                                <option>Indisponível</option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.status"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="curso"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Curso</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="cursoSelected"
                                @change="form.curso_id = cursoSelected"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Selecione uma opção</option>
                                <option
                                    v-for="item in cursos"
                                    :key="item.id"
                                    :value="item.id"
                                >
                                    {{ item.nome }}
                                </option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.curso_id"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="formador"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Formador</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="formadorSelected"
                                @change="form.instrutor_id = formadorSelected"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Selecione uma opção</option>
                                <option
                                    v-for="item in instrutor"
                                    :key="item.id"
                                    :value="item.id"
                                >
                                    {{ item.nome }}
                                </option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.instrutor_id"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="horario"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Horário</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="categoriaSelected"
                                @change="form.horario_id = categoriaSelected"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Selecione uma opção</option>
                                <option
                                    v-for="item in horarios"
                                    :key="item.id"
                                    :value="item.id"
                                >
                                    {{ item.id }}
                                </option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.horario_id"
                            />
                        </div>
                    </div>
                </div>
                <div class="m-5 flex justify-end">
                    <SecondaryButton class="mx-2" @click="adicionarTurma">
                        Adicionar
                    </SecondaryButton>
                    <SecondaryButton class="bg-red-600" @click="close">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Modal>
    </admin-layout>
</template>

<style scoped></style>
