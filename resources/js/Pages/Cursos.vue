<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import TableButton from "@/Components/TableButton.vue";
import Pagination from "@/Components/Pagination.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import { computed, ref, watch } from "vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Swal from "sweetalert2";
import { Inertia } from "@inertiajs/inertia";

const Props = defineProps({
    values: Object,
    filters: Object,
});
const { props } = usePage();
const form = useForm({
    nome: "",
    descricao: "",
    duracao: "",
    preco: null,
    data_inicio: null,
    data_termino: null,
    local: "",
    vagas: null,
    requisitos: "",
    status: "",
    categories_id: null,
});
const display = ref(false);
const showForm = ref(false);
const search = ref(Props.filters.search);
const idSelected = ref("");
const modalData = ref({});
const statuSelect = ref("");
const categories = ref([]);
const categoriaSelected = ref("");
const editForm = ref(false);

categories.value = props.categorie;

const nomeRegex = /^[A-Za-zÀ-ú\s]{5,}$/;
const idRegex = /^\d+$/;
const precoRegex = /[1-9]\d*(?:\.\d{1,2})?|0\.\d{1,2}/;

const validateDataInicio = () => {
    const dataInicio = new Date(form.data_inicio);
    const today = new Date();
    if (dataInicio <= today) {
        form.errors.data_inicio = "Data inválida";
    } else {
        form.errors.data_inicio = "";
    }
};
const validateDataTermino = () => {
    const dataTermino = new Date(form.data_termino);
    const today = new Date();
    if (dataTermino <= today) {
        form.errors.data_termino = "Data inválida";
    } else {
        form.errors.data_termino = "";
    }
};

const validateNome = (value) => {
    if (value === 1) {
        form.errors.nome = nomeRegex.test(modalData.nome)
            ? ""
            : "Nome inválido";
    }
    form.errors.nome = nomeRegex.test(form.nome) ? "" : "Nome inválido";
    x;
};

const validateLocal = () => {
    form.errors.local = nomeRegex.test(form.local) ? "" : "Local inválido";
};
const validateDescricao = () => {
    form.errors.descricao = nomeRegex.test(form.descricao)
        ? ""
        : "Descrição inválido";
};
const validateDuracao = () => {
    const duracaoRegex = /[A-Za-z0-9]+/;
    form.errors.duracao = duracaoRegex.test(form.duracao)
        ? ""
        : "Duração inválido";
};
const validatePreco = () => {
    form.errors.preco = precoRegex.test(form.preco) ? "" : "Preço inválido";
};

const validateVagas = () => {
    form.errors.vagas = idRegex.test(form.vagas) ? "" : "Valor inválido";
};
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

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

const close = (flag) => {
    if (flag) {
        Swal.fire({
            title: "Tem certeza?",
            text: "You won't be able to revert this!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#2dc61a",
            cancelButtonText: "Não",
            confirmButtonText: "Yes, cancel it!",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                showForm.value = false;
                editForm.value = false;
                Toast.fire({
                    title: "Cancelado!",
                    text: "Cancelado com sucesso.",
                    icon: "success",
                });
            }
        });
    }
    display.value = false;
};

const itemEncontrado = computed(() => {
    for (const chave in Props.values.data) {
        // Verificar se a chave é um ID e se corresponde ao ID procurado
        if (Props.values.data[chave].id === idSelected.value) {
            return Props.values.data[chave];
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

const editCurso = (id) => {
    editForm.value = true;
    idSelected.value = id;
    modalData.value = itemEncontrado.value;
};

const addCurso = () => {
    showForm.value = true;
};

const adicionarCurso = () => {
    form.processing = true;
    form.post("cursos/create", {
        onError: () => {
            Toast.fire({
                icon: "error",
                title: "Houve um erro",
                text: "Verifique os campos digitados",
            });
        },
        onSuccess: () => {
            Toast.fire({
                icon: "success",
                title: "Curso registrado",
                text: "Curso registrado com sucesso",
            });
            setTimeout(() => {
                form.reset();
                showForm.value = false;
            }, 3000);
        },
    });
};
const updateCurso = (id) => {
    form.processing = true;
    router.put(`cursos/${id}`, modalData.value, {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 1500,
            }).then(() => {
                router.visit("/cursos");
            });
        },
    });
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
                                            <TableButton
                                                @click="
                                                    showMore(true, curso.id)
                                                "
                                                status="ver"
                                            />
                                            <TableButton status="delete" />
                                            <TableButton
                                                status="edit"
                                                @click="editCurso(curso.id)"
                                            />
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
                    <SecondaryButton @click="close(false)">
                        Cancel
                    </SecondaryButton>
                </div>
            </div>
        </Modal>
        <Modal :show="showForm">
            <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <input-label
                            for="nome"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Nome do curso</input-label
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
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="duracao"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Duração</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="duracao"
                                id="duracao"
                                v-model="form.duracao"
                                @input="validateDuracao"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.duracao"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="preco"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Preço</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="number"
                                name="preco"
                                id="preco"
                                v-model="form.preco"
                                @input="validatePreco"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.preco"
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
                            >Data de início</input-label
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
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.local"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="vagas"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Vagas</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="number"
                                name="vagas"
                                id="vagas"
                                v-model="form.vagas"
                                @input="validateVagas"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.vagas"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="requisitos"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Requisitos</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="requisitos"
                                id="requisitos"
                                v-model="form.requisitos"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.requisitos"
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
                            for="categorias"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Categoria</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="categoriaSelected"
                                @change="form.categories_id = categoriaSelected"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Selecione uma opção</option>
                                <option
                                    v-for="item in categories"
                                    :key="item.id"
                                    :value="item.id"
                                >
                                    {{ item.nome }}
                                </option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.categories_id"
                            />
                        </div>
                    </div>
                </div>
                <div class="m-5 flex justify-end">
                    <SecondaryButton class="mx-2" @click="adicionarCurso">
                        Adicionar
                    </SecondaryButton>
                    <SecondaryButton class="bg-red-600" @click="close">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Modal>
        <Modal :show="editForm">
            <form action="#" method="POST" class="mx-auto max-w-xl sm:mt-20">
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div>
                        <input-label
                            for="nome"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Nome do curso</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="nome"
                                v-model="modalData.nome"
                                autocomplete="given-name"
                                @input="validateNome(1)"
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
                            for="descricao"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Descrição</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="descricao"
                                id="descricao"
                                v-model="modalData.descricao"
                                @input="validateDescricao"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.descricao"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="duracao"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Duração</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="duracao"
                                id="duracao"
                                v-model="modalData.duracao"
                                @input="validateDuracao"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.duracao"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="preco"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Preço</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="number"
                                name="preco"
                                id="preco"
                                v-model="modalData.preco"
                                @input="validatePreco"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.preco"
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
                            >Data de início</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="date"
                                name="data_inicio"
                                id="data_inicio"
                                v-model="modalData.data_inicio"
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
                                v-model="modalData.data_termino"
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
                            for="local"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Local</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="local"
                                id="local"
                                v-model="modalData.local"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.local"
                            />
                        </div>
                    </div>
                    <div>
                        <input-label
                            for="vagas"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Vagas</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="number"
                                name="vagas"
                                id="vagas"
                                v-model="modalData.vagas"
                                @input="validateVagas"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.vagas"
                            />
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2"
                >
                    <div>
                        <input-label
                            for="requisitos"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Requisitos</input-label
                        >
                        <div class="mt-2.5">
                            <text-input
                                type="text"
                                name="requisitos"
                                id="requisitos"
                                v-model="modalData.requisitos"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                            <input-error
                                class="mt-2"
                                :message="form.errors.requisitos"
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
                                v-model="modalData.status"
                                @change=""
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
                            for="categorias"
                            class="block text-sm font-semibold leading-6 text-gray-900"
                            >Categoria</input-label
                        >
                        <div class="mt-2.5">
                            <select
                                v-model="modalData.categories_id"
                                @change="form.categories_id = categoriaSelected"
                                class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                            >
                                <option>Selecione uma opção</option>
                                <option
                                    v-for="item in categories"
                                    :key="item.id"
                                    :value="item.id"
                                >
                                    {{ item.nome }}
                                </option>
                            </select>
                            <input-error
                                class="mt-2"
                                :message="form.errors.categories_id"
                            />
                        </div>
                    </div>
                </div>
                <div class="m-5 flex justify-end">
                    <SecondaryButton
                        class="mx-2"
                        @click="updateCurso(modalData.id)"
                    >
                        Atualizar
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
