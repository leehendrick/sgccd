<script setup>
import {Head,  } from '@inertiajs/vue3';
import { route } from '@inertiajs/inertia-vue3';


import {
  AcademicCapIcon,
  BookOpenIcon,
  BuildingOffice2Icon,
  CheckBadgeIcon,

} from '@heroicons/vue/20/solid'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {Inertia} from "@inertiajs/inertia";

const features = [
  {
        name: 'Formadores Qualificados',
        description:
        'No coração de qualquer experiência educacional excepcional está a qualidade e a dedicação dos formadores. Em nossos laboratórios, temos uma equipe de instrutores qualificados.',
        icon: AcademicCapIcon,
      },
      {
        name: 'Ensino de Qualidade',
        description:
        'Acreditamos que a educação é a chave para o sucesso pessoal e profissional, e é por isso que nos dedicamos a oferecer uma experiência excepcional em todos os cursos que oferecemos.',
        icon: CheckBadgeIcon,
      },
      {
        name: 'Aprendizado para Empresas',
        description:
        'Em nossos laboratórios, não nos limitamos apenas a atender às necessidades individuais de aprendizado; também fornecemos soluções adaptadas às demandas e objetivos das empresas.',
        icon: BuildingOffice2Icon,
      },
      {
        name: 'Variedade de cursos',
        description:
        'Nos orgulhamos de oferecer uma ampla variedade de cursos projetados para atender a uma ampla gama de interesses, objetivos e níveis de habilidade.',
        icon: BookOpenIcon,
      },
  ]

document.addEventListener('DOMContentLoaded', function() {
  var texts = document.querySelectorAll('.text');

  function checkVisibility() {
    texts.forEach(function(text) {
      if (isElementInViewport(text)) {
        text.classList.add('visible');
      }
    });
  }

  function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  window.addEventListener('scroll', checkVisibility);
  checkVisibility(); // Execute a função ao carregar a página
});

defineProps({
  cursos: Array
})

 async function Inscrever(id){
  try{
    window.alert(`id: ${id}`)
    const response = axios.get(`/inscricoes/${id}`);
    if (response.status == 200) {
      location.href = '/inscricoes';
    }
  }
  catch (e){

  }

}

</script>

<template>
  <Head title="Welcome"/>

  <div
      class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
  >
    <div class="bg-white h-full w-full">
      <!-- Header -->
        <div>
          <!-- Outros conteúdos do componente Welcome -->
          <landing-layout>
            <main class="isolate ">
              <!-- Feature section -->
              <div class="relative w-full h-screen">
                <img class="w-full h-full object-cover" src="/estudante-sem-fundo.png" alt="Imagem">
                <div class="absolute inset-0 flex justify-center items-center lg:justify-start">
                  <div class="w-full h-full max-w-2xl px-6 py-8  text-white">
                    <div class="lg:text-left mt-32 lg:mx-auto">
                      <h1 class="typed-text mt-2 text-5xl font-bold tracking-tight text-primary sm:text-7xl transition  ease-in-out">Cursos de </h1>
                      <h1 class="typed-text mt-2 pb-1 text-5xl font-bold tracking-tight text-primary sm:text-7xl transition  ease-in-out">Curta Duração</h1>
                      <p class="mt-6 text-lg leading-8 text-secondary">Explore nossos cursos de curta duração! Oferecidos pelos <strong>laboratórios profissionalizantes do isptec</strong>, capacite-se com habilidades práticas para impulsionar sua carreira acadêmica e profissional.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="container relative md:pt-20 lg:pt-24 pt-13 mt-96 lg:mt-16 xl:mt-20 bg-white">
                <div class="absolute inset-0 flex justify-center items-center">
                  <div class="py-8 px-4 sm:px-8 md:px-10 lg:px-12 xl:px-16 2xl:px-24 mt-8 sm:mt-10 md:mt-12 lg:mt-16 xl:mt-20">
                    <dl class="lg:mt-20 hidden-scroll grid max-w-full md:max-w-xl grid-cols-1 gap-x-8 gap-y-10 sm:gap-y-12 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                      <div v-for="feature in features" :key="feature.name" class="relative pl-8 md:pl-16">
                        <dt class="text-base sm:text-lg font-semibold leading-7 text-gray-900">
                          <div class="absolute sm:mr-5 left-0 top-0 flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-lg bg-primary">
                            <component :is="feature.icon" class="h-5 w-5 sm:h-6 sm:w-6 text-white" aria-hidden="true" />
                          </div>
                          {{ feature.name }}
                        </dt>
                        <dd class="mt-2 text-sm sm:text-base leading-7 text-gray-600">{{ feature.description }}</dd>
                      </div>
                    </dl>
                  </div>
                </div>
              </div>

              <div class="container md:pt-52 pt-96 mx-auto sm:px-6 lg:px-8">
                <div class="mx-auto mt-20 lg:mt-0 md:lg:mt-96 sm:mt-72 max-w-7xl px-4 sm:px-6 lg:px-8">
                  <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-32 lg:max-w-4xl">
                    <div class="w-full">
                      <h2 class="text-center text-3xl sm:text-5xl font-bold mb-6 sm:mb-10 text-primary">Cursos Disponíveis</h2>
                      <hr class="my-4 sm:my-8 border-t-2 sm:border-t-4 w-1/2 sm:w-1/4 border-primary mx-auto rounded-full">
                      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        <div v-for="(curso, index) in cursos" :key="index" class="text-center p-4 cursor-pointer transition-transform ease-in-out transform hover:scale-105">
                          <div class="card bg-white hover:bg-primary hover:text-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold mb-2">{{ curso.nome }}</h3>
                            <p class="text-sm">{{ curso.descricao }}</p>
                            <p class="mt-4 text-gray-500 text-sm">{{ curso.duracao }}</p>
                            <p class="mt-4 text-gray-500 text-sm">{{ curso.preco }},00 AOA</p>
                            <secondary-button @click.prevent.default="Inscrever(curso.id)" class="mt-5 my-btn">Inscrever-se</secondary-button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </main>
          </landing-layout>
        </div>
    </div>
    </div>
</template>

<style>

</style>
