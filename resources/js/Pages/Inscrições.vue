<script setup>
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import { onMounted, ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Swal from "sweetalert2";

const form = useForm({
    nome: "",
    email: "",
    bi: "",
    data_nascimento: "",
    instituicao: "",
    area_formacao: "",
    data_inscricao: "",
    genero: "",
    telefone: null,
    curso_id: null,
    nivel_academico_id: null,
});
const selectedOption = ref("Individual");
const academicLevel = ref("");
const cursoSelect = ref("");
const cursosData = ref([]);
const fills = ref([]);
const academic_level = ref([]);
const genero = ref([]);
const { props } = usePage();

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

const submit = () => {
    form.processing = true;
    form.post("inscricoes", {
        onError: () => {
            Toast.fire({
                icon: "error",
                title: "Houve um erro",
                text: "Verifique os campos digitados",
            });
        },
        onSuccess: () => {
            Swal.fire({
                icon: "success",
                title: "Solicitação enviada",
                text: "Sua solicitação foi processada com sucesso",
                showConfirmButton: true,
                position: "center",
            });
            form.reset();
        },
    });
};

async function getCurso(id) {
    const response = await axios.get(`inscricoes/${id}`);
    if (response.status === 200) {
        console.log("Everything looks fine", response.data);
        cursosData.value = response.data;
    } else {
        console.log("Bad thing happened");
    }
}

function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, "0");
    const day = today.getDate().toString().padStart(2, "0");
    form.data_inscricao = `${year}-${month}-${day}`;
    console.log(form.data_inscricao);
}

const nomeRegex = /^[A-Za-zÀ-ú\s]{5,}$/;
const datasRegex = /^\d{4}-\d{2}-\d{2}$/;
const idRegex = /^\d+$/;

const validateNome = () => {
    form.errors.nome = nomeRegex.test(form.nome) ? "" : "Nome inválido";
};
const validateTelefone = () => {
    const telefoneRegex = /9[9|1-5]\d{7}$/gm;
    form.errors.telefone = telefoneRegex.test(form.telefone)
        ? ""
        : "Telefone inválido";
};
const validateBi = () => {
    const biRegex = /^\d{9}[A-Z]{2}\d{3}$/;
    form.errors.bi = biRegex.test(form.bi) ? "" : "BI inválido";
};
const validateEmail = () => {
    const emailRegex = /^[\w-.]+@([\w-]+\.)+[\w-]{2,4}$/;
    form.errors.email = emailRegex.test(form.email) ? "" : "Email inválido";
};
const validateInstituicao = () => {
    form.errors.instituicao = nomeRegex.test(form.instituicao)
        ? ""
        : "Instituição inválido";
};
const validateAreaForma = () => {
    form.errors.area_formacao = nomeRegex.test(form.area_formacao)
        ? ""
        : "Area de formação inválido";
};

const validateGenero = () => {
    const generoRegex = /^[MF]$/;
    form.errors.genero = generoRegex.test(form.genero) ? "" : "Género inválido";
};
const validateNivelAcadem = () => {
    form.errors.nivel_academico_id = idRegex.test(form.nivel_academico_id)
        ? ""
        : "Nível acadêmico inválido";
};
const validateDataNascimento = () => {
    const birthDate = new Date(form.data_nascimento);
    const today = new Date();
    if (birthDate >= today) {
        form.errors.data_nascimento = "Data de nascimento inválido ?";
    } else {
        form.errors.data_nascimento = "";
    }
};

fills.value = props.cursos;
academic_level.value = props.academic_level;

onMounted(() => {
    getCurrentDate();
});
</script>

<template>
    <Head title="Inscrições" />
    <landing-layout>
        <section class="relative w-full mr-5 mt-20 p-5">
            <div class="">
                <p>Escolha o tipo de inscrição</p>
                <div class="inline-flex">
                    <div class="my-5 px-5">
                        <select
                            v-model="selectedOption"
                            class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                        >
                            <option>Individual</option>
                            <option>Empresarial</option>
                        </select>
                    </div>
                    <div class="my-5">
                        <select
                            @change="
                                getCurso(cursoSelect);
                                form.curso_id = cursoSelect;
                                console.log(form.curso_id);
                            "
                            v-model="cursoSelect"
                            class="border rounded border-secondary focus:border-secondary focus:ring-secondary"
                        >
                            <option
                                v-for="fill in fills"
                                :key="fill.id"
                                :value="fill.id"
                            >
                                {{ fill.nome }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row">
                <!-- Primeiro contêiner -->
                <div
                    v-if="selectedOption !== 'Empresarial'"
                    class="sm:border-r-0 sm:border-none border-r-2 border-primary w-full shadow-xl md:w-3/5 bg-gray-50 flex justify-center items-center"
                >
                    <div class="p-5">
                        <form @submit.prevent="submit" class="w-96">
                            <div class="mt-4 w-full">
                                <InputLabel for="name" value="Nome Completo" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.nome"
                                    required
                                    @input="validateNome"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.nome"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="current-password"
                                    @input="validateEmail"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="bi" value="Número do B.I" />

                                <TextInput
                                    id="bi"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.bi"
                                    required
                                    autocomplete="current-password"
                                    @input="validateBi"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.bi"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel
                                    for="data_nasci"
                                    value="Data de Nascimento"
                                />

                                <TextInput
                                    id="data_nasci"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.data_nascimento"
                                    required
                                    autocomplete="current-password"
                                    @input="validateDataNascimento"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.data_nascimento"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel
                                    for="instituicao"
                                    value="Instituicao"
                                />

                                <TextInput
                                    id="instituicao"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.instituicao"
                                    required
                                    autocomplete="current-password"
                                    @input="validateInstituicao"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.instituicao"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel
                                    for="area_formac"
                                    value="Área de Formação"
                                />

                                <TextInput
                                    id="area_formac"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.area_formacao"
                                    required
                                    autocomplete="current-password"
                                    @input="validateAreaForma"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.area_formacao"
                                />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="telefone" value="Telefone" />

                                <input
                                    @input="validateTelefone"
                                    id="telefone"
                                    v-model="form.telefone"
                                    required
                                    type="number"
                                    class="mt-1 block w-full border-secondary focus:border-secondary focus:ring-secondary rounded-md shadow-sm"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.telefone"
                                />
                            </div>

                            <div class="my-5">
                                <InputLabel
                                    @input="validateNivelAcadem"
                                    for="academicLevel"
                                    value="Selecione o nível acadêmico"
                                />
                                <select
                                    v-model="academicLevel"
                                    @change="
                                        form.nivel_academico_id = academicLevel
                                    "
                                    id="academicLevel"
                                    class="w-full border mt-2 rounded border-secondary focus:border-secondary focus:ring-secondary"
                                >
                                    <option>Selecione um opção</option>
                                    <option
                                        v-for="item in academic_level"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.nome }}
                                    </option>
                                </select>
                            </div>
                            <div class="my-5">
                                <InputLabel
                                    @input="validateGenero"
                                    for="academicLevel"
                                    value="Selecione o gênero"
                                />
                                <select
                                    v-model="genero"
                                    @change="form.genero = genero"
                                    id="academicLevel"
                                    class="w-full border mt-2 rounded border-secondary focus:border-secondary focus:ring-secondary"
                                >
                                    <option>M</option>
                                    <option>F</option>
                                </select>
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <span class="ms-2 text-sm text-gray-600"
                                        >Something</span
                                    >
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <primary-button :disabled="form.processing"
                                    >Enviar</primary-button
                                >
                            </div>
                        </form>
                    </div>
                </div>

                <div
                    v-if="selectedOption !== 'Individual'"
                    class="sm:border-r-0 sm:border-none border-r-2 border-primary w-full shadow-xl md:w-3/5 bg-gray-50 flex justify-center items-center"
                >
                    <div class="p-5">
                        <p>Individual</p>
                    </div>
                </div>

                <!-- Segundo contêiner -->
                <div class="w-full md:w-2/5 bg-gray-50 shadow-xl p-5">
                    <div class="">
                        <div
                            class="text-center p-4 cursor-pointer transition-transform ease-in-out transform hover:scale-105"
                        >
                            <div
                                v-for="cursoData in cursosData"
                                class="card bg-primary text-white rounded-lg shadow-md p-6"
                            >
                                <h3 class="text-xl font-extrabold mb-2">
                                    {{ cursoData.nome }}
                                </h3>
                                <p class="text-sm">{{ cursoData.descricao }}</p>
                                <p class="mt-2 text-sm">
                                    {{ cursoData.duracao }}
                                </p>
                                <p class="mt-2 text-sm">
                                    {{ cursoData.preco }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div v-if="selectedOption !== 'Individual'" class="">
                        <div
                            class="text-center p-4 cursor-pointer transition-transform ease-in-out transform hover:scale-105"
                        >
                            <div
                                class="card bg-white hover:bg-primary hover:text-white rounded-lg shadow-md p-6"
                            >
                                <h3 class="text-lg font-bold mb-2"></h3>
                                <p class="text-sm">Text</p>
                                <p class="mt-4 text-sm">Text</p>
                                <p class="mt-4 text-sm">Text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </landing-layout>
</template>

<style scoped></style>
