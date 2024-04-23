<script setup>

  const props = defineProps({
    status: {
      type: String,
      required: true,
    },

    emits: [],
  });

</script>

<template>

  <button v-if="status === 'ver'" v-on:click="$emit('click', $event)" class="bg-btnSee hover:bg-btnSeeHover p-2 ml-1 rounded-full text-white inline-flex items-center justify-center focus:border-secondary focus:ring-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
      <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
      <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
    </svg>
  </button>


  <button v-if="status === 'delete'" class="bg-red-600  hover:bg-red-700 p-2 ml-1 rounded-full text-white inline-flex items-center justify-center focus:border-secondary focus:ring-secondary">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
  </button>

  <button v-if="status === 'edit'" class="bg-indigo-600 hover:bg-indigo-700 p-2 ml-1 rounded-full text-white inline-flex items-center justify-center focus:border-secondary focus:ring-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
      <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
    </svg>
  </button>

  <button v-if="status === 'confirm'" class="bg-green-600 hover:bg-green-700 p-2 ml-1 rounded-full text-white inline-flex items-center justify-center focus:border-secondary focus:ring-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
      <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
    </svg>
  </button>

</template>

<style scoped>

</style>