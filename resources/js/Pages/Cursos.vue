<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import TableButton from "@/Components/TableButton.vue";
import Pagination from "@/Components/Pagination.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {computed, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

const props = defineProps({
  values: Object,
  filters: Object
})

const display = ref(false);
const search = ref(props.filters.search);
const idSelected = ref('');
const modalData = ref({});

watch(search, value => {
  router.get('/cursos', { search: value }, {
    preserveState: true,
    replace: true,
  });
})

const close = (value) => {
  display.value = value
}

const itemEncontrado = computed(() => {
  for (const chave in props.values.data) {
    // Verificar se a chave é um ID e se corresponde ao ID procurado
    if (props.values.data[chave].id === idSelected.value) {
      return props.values.data[chave]
    }
  }
  return null
})

const showMore = (value, id) => {
  display.value = value
  idSelected.value = id
  modalData.value = itemEncontrado.value
  console.log(modalData.value)
}
</script>

<template>
    <admin-layout>
      <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Cursos</h1>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <input v-model="search" type="text" placeholder="Search..." class="focus:border-secondary focus:ring-secondary rounded-md shadow-sm ">
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nome</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Vagas</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Duração</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="curso in values.data" :id="curso.id">
                  <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                    <div class="flex items-center">
                      <div class="">
                        <div class="font-medium text-gray-900">{{ curso.nome }}</div>
                        <div class="mt-1 text-gray-500"></div>
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <div class="text-gray-900">{{ curso.vagas }}</div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <div class="mt-1 text-gray-500">{{ curso.duracao }}</div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <span class="inline-flex items-center rounded-md  px-2 py-1 text-xs font-medium" :class="curso.status === 'aberto' ? 'bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20': 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/20'">{{ curso.status }}</span>
                  </td>
                  <td class="relative whitespace-nowrap px-5 py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <div>
                      <TableButton @click="" status="ver"/>
                      <TableButton status="delete"/>
                      <TableButton status="confirm"/>
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
      <Pagination :links="values.links" class="mt-6"/>
      <Modal :show="display" @close="">
        <div class="p-6 ">
          <h2 class="text-lg font-medium text-gray-900">
            Dados do solicitante
          </h2>
          <div class=" mt-2 text-xl bold border-t border-gray-900/10 ">
            <p class="mt-2 text-sm text-gray-600">
              <strong>Nome</strong>  : {{modalData.nome}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>Email</strong> : {{modalData.email}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>B.I</strong> : {{modalData.bi}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>Data de Nascimento</strong> : {{modalData.data_nascimento}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>Instituição</strong> : {{modalData.instituicao}}
            </p>
            <p class="mt-1 text-sm text-gray-600">
              <strong>Área de Formação</strong> : {{modalData.area_formacao}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>Telefone</strong> : {{modalData.telefone}}
            </p>
            <p class="mt-2 text-sm text-gray-600">
              <strong>Data de Inscrição</strong> : {{modalData.data_inscricao}}
            </p>
          </div>
          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="close(false)"> Cancel </SecondaryButton>
          </div>
        </div>
      </Modal>
    </admin-layout>
</template>

<style scoped>

</style>