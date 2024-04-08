<script setup>
import {Head, Link} from "@inertiajs/vue3";
import LandingHeader from "@/Components/LandingHeader.vue";
import LandingLayout from "@/Layouts/LandingLayout.vue";
</script>

<template>
  <Head title="Inscrições"/>
  <landing-layout>
      <section class="relative border border-primary w-full mr-5 mt-28 p-5">
        <div class="flex flex-col md:flex-row">
        <!-- Primeiro contêiner -->
        <div class="w-full md:w-3/5 bg-gray-200">
          <!-- Conteúdo do primeiro contêiner aqui -->
        </div>

        <!-- Linha horizontal -->
        <div class="w-full md:hidden h-1 bg-black my-4"></div>

        <!-- Segundo contêiner -->
        <div class="w-full md:w-2/5 bg-gray-300">
          <!-- Conteúdo do segundo contêiner aqui -->
        </div>
      </div>

      </section>
  </landing-layout>
</template>

<style scoped>

</style>