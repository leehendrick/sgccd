<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {onMounted, ref, watch} from "vue";
import Pagination from "@/Components/Pagination.vue";
import {router} from "@inertiajs/vue3";
import TableButton from "@/Components/TableButton.vue";

const props = defineProps({
  values: Object,
  filters: Object
})


const search = ref(props.filters.search);

watch(search, value => {
  router.get('/solicitacoes', { search: value }, {
    preserveState: true,
    replace: true,
  });
})

onMounted(() => {

})
</script>

<template>
  <admin-layout>
      <div class="px-4 sm:px-6 lg:px-8 mt-10">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Solicitações</h1>
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
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Número de BI</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Instituição</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="person in values.data" :key="person.email">
                  <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                    <div class="flex items-center">
                      <div class="">
                        <div class="font-medium text-gray-900">{{ person.nome }}</div>
                        <div class="mt-1 text-gray-500">{{ person.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <div class="text-gray-900">{{ person.bi }}</div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <div class="mt-1 text-gray-500">{{ person.instituicao }}</div>
                    </td>
                  <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                  </td>
                  <td class="relative whitespace-nowrap px-5 py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                    <TableButton status="ver"/>
                    <TableButton status="delete"/>
                    <TableButton status="edit"/>
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
  </admin-layout>
</template>

<style scoped>

</style>