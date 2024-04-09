<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import LandingHeader from "@/Components/LandingHeader.vue";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Inertia } from "@inertiajs/inertia";

const form = useForm({
  name: '',
  email: '',
  bi: '',
  data_nascimento: '',
  instituicao: '',
  area_formacao: '',
  data_inscricao: '',
  genero: '',
  telefone: '',
  curso_id: '',
  nivel_academic: '',
  remember: false,
});

const submit = () => {
  Inertia.post('/inscricoes', form );
}
const selectedOption = ref('Individual')
</script>

<template>
  <Head title="Inscrições"/>
  <landing-layout>
      <section class="relative w-full mr-5 mt-20 p-5">
        <div class="">
          <p>Escolha o tipo de inscrição</p>
          <div class="my-5">
              <select v-model="selectedOption" class="border rounded border-secondary focus:border-secondary focus:ring-secondary">
                <option>Individual</option>
                <option>Empresarial</option>
              </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
        <!-- Primeiro contêiner -->
          <div v-if="selectedOption !== 'Empresarial'"  class="border-r-2 border-primary w-full shadow-xl md:w-3/5 bg-gray-50 flex justify-center items-center">
            <div class="p-5">
              <form @submit.prevent="submit" class="w-96">
                <div class="mt-4 w-full">
                  <InputLabel for="name" value="Nome Completo" />

                  <TextInput
                      id="name"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.name"
                      required
                  />

                  <InputError class="mt-2" :message="form.errors.name" />
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
                  />

                  <InputError class="mt-2" :message="form.errors.email" />
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
                  />

                  <InputError class="mt-2" :message="form.errors.bi" />
                </div>

                <div class="mt-4">
                  <InputLabel for="data_nasci" value="Data de Nacimento" />

                  <TextInput
                      id="data_nasci"
                      type="date"
                      class="mt-1 block w-full"
                      v-model="form.data_nascimento"
                      required
                      autocomplete="current-password"
                  />

                  <InputError class="mt-2" :message="form.errors.data_nascimento" />
                </div>

                <div class="mt-4">
                  <InputLabel for="instituicao" value="Instituicao" />

                  <TextInput
                      id="instituicao"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.instituicao"
                      required
                      autocomplete="current-password"
                  />

                  <InputError class="mt-2" :message="form.errors.instituicao" />
                </div>

                <div class="mt-4">
                  <InputLabel for="area_formac" value="Área de Formação" />

                  <TextInput
                      id="area_formac"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.area_formacao"
                      required
                      autocomplete="current-password"
                  />

                  <InputError class="mt-2" :message="form.errors.area_formacao" />
                </div>

                <div class="mt-4">
                  <InputLabel for="telefone" value="Telefone" />

                  <TextInput
                      id="telefone"
                      type="number"
                      class="mt-1 block w-full"
                      v-model="form.telefone"
                      required
                      autocomplete="current-password"
                  />

                  <InputError class="mt-2" :message="form.errors.telefone" />
                </div>

                <div class="block mt-4">
                  <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                  </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <primary-button>Enviar</primary-button>
                </div>
              </form>
            </div>
          </div>

          <div  v-if="selectedOption !== 'Individual'" class="border-r-2 border-primary w-full shadow-xl md:w-3/5 bg-gray-50 flex justify-center items-center">
            <div class="p-5">
              <p>Individual</p>
            </div>
          </div>

          <!-- Segundo contêiner -->
        <div class="w-full md:w-2/5 bg-gray-50 shadow-xl  p-5">
          <!-- Conteúdo do segundo contêiner aqui -->
          Cursos
        </div>
      </div>

      </section>
  </landing-layout>
</template>

<style scoped>

</style>