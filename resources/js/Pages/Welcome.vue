<script setup>
import {Head, Link} from '@inertiajs/vue3';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

import {onMounted, ref} from 'vue'
  import {Dialog, DialogPanel} from '@headlessui/vue'
  import {
  Bars3Icon,
  XMarkIcon,
} from '@heroicons/vue/24/outline'
import {
  AcademicCapIcon,
  BookOpenIcon,
  BuildingOffice2Icon,
  CheckBadgeIcon,
  CheckIcon,
  UserIcon
} from '@heroicons/vue/20/solid'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

  const navigation = [
  {name: 'Home', href: '#'},
  {name: 'Inscrições', href: '#'},
  {name: 'Contatos', href: '#'},
  {name: 'LabPro', href: '#'},
  ]
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
const footerNavigation = {
  solutions: [
    {name: 'Hosting', href: '#'},
    {name: 'Data Services', href: '#'},
    {name: 'Uptime Monitoring', href: '#'},
    {name: 'Enterprise Services', href: '#'},
  ],
  support: [
    {name: 'Pricing', href: '#'},
    {name: 'Documentation', href: '#'},
    {name: 'Guides', href: '#'},
    {name: 'API Reference', href: '#'},
      ],
  company: [
    {name: 'About', href: '#'},
    {name: 'Blog', href: '#'},
    {name: 'Jobs', href: '#'},
    {name: 'Press', href: '#'},
    {name: 'Partners', href: '#'},
      ],
      legal: [
    {name: 'Claim', href: '#'},
    {name: 'Privacy', href: '#'},
    {name: 'Terms', href: '#'},
      ],
}

const mobileMenuOpen = ref(false)

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

const cursos = ref([
  {
    titulo: 'Curso de Desenvolvimento Web',
    descricao: 'Aprenda as últimas tecnologias de desenvolvimento web, incluindo HTML, CSS, JavaScript e frameworks populares como Vue.js e React.',
    duracao: 'Duração: 8 semanas'
  },
  {
    titulo: 'Curso de Marketing Digital',
    descricao: 'Descubra estratégias eficazes de marketing digital, incluindo SEO, PPC, mídias sociais, email marketing e análise de dados.',
    duracao: 'Duração: 6 semanas'
  },
  {
    titulo: 'Curso de Design Gráfico',
    descricao: 'Domine os princípios do design gráfico, incluindo teoria das cores, tipografia, layout e ferramentas de design como Adobe Illustrator e Photoshop.',
    duracao: 'Duração: 10 semanas'
  }
]);
</script>

<template>
  <Head title="Welcome"/>

  <div
      class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
  >
    <div class="bg-white h-full w-full">
      <!-- Header -->
      <header class="inset-x-0 top-0 z-50 bg-white fixed">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt=""/>
            </a>
          </div>
          <div class="flex lg:hidden">
            <button type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    @click="mobileMenuOpen = true">
              <span class="sr-only">Open main menu</span>
              <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
            </button>
          </div>
          <div class="hidden lg:flex lg:gap-x-12">
            <a v-for="item in navigation" :key="item.name" :href="item.href"
               class="text-lg  leading-6 hover:text-primary transition duration-300 ease-in-out">{{ item.name }}</a>
          </div>
          <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
              <Link
                  v-if="$page.props.auth.user"
                  :href="route('dashboard')"
                  class="text-lg font-bold text-gray-600 hover:text-primary transition duration-300 ease-in-out dark:text-gray-400 dark:hover: focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
              >Dashboard
              </Link
              >

              <template v-else>
                <Link
                    :href="route('login')"
                    class="text-lg font-bold hover:text-primary transition duration-300 ease-in-out dark:text-gray-400 dark:hover: focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Log in
                </Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 text-lg font-bold hover:text-primary transition duration-300 ease-in-out dark:text-altern dark:hover: focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Register
                </Link
                >
              </template>
            </div>
          </div>
        </nav>
        <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
          <div class="fixed inset-0 z-50"/>
          <DialogPanel
              class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
              <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                     alt=""/>
              </a>
              <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                <span class="sr-only">Close menu</span>
                <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
              </button>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                  <a v-for="item in navigation" :key="item.name" :href="item.href"
                     class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">{{
                      item.name
                    }}</a>
                </div>
                <div class="py-6">
                  <a href="#"
                     class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                    in</a>
                </div>
              </div>
            </div>
          </DialogPanel>
        </Dialog>
        <hr/>
      </header>

      <main class="isolate">
        <!-- Feature section -->
        <div class="relative w-full h-screen">
        <img class="w-full h-full object-cover" src="/estudante-sem-fundo.png" alt="Imagem">
          <img src="/wave-dark-primary.svg" alt="Imagem" class="absolute inset-0 w-full h-full mt-48">
        <div class="absolute inset-0 flex justify-center items-center lg:justify-start">
          <div class="w-full h-full max-w-2xl px-6 py-8  text-white">
            <div class="lg:text-left mt-32 lg:mx-auto">
              <h1 class="typed-text mt-2 text-5xl font-bold tracking-tight text-primary sm:text-7xl transition  ease-in-out">Cursos de </h1>
              <h1 class="typed-text mt-2 pb-1 text-5xl font-bold tracking-tight text-primary sm:text-7xl transition  ease-in-out">Curta Duração</h1>
              <p class="mt-6 text-lg leading-8 text-secondary">Explore nossos cursos de curta duração! Oferecidos pelos <strong>laboratórios profissionalizantes do isptec</strong>, capacite-se com habilidades práticas para impulsionar sua carreira acadêmica e profissional.</p>
            </div>
          </div>
        </div>
          <div class="container relative overflow-hidden bg-white" style="height: 400px;">
            <div class="absolute inset-0 flex justify-center items-center">
              <div class="py-10 px-24 z-10">
                <dl class="text hidden-scroll grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                  <div v-for="feature in features" :key="feature.name" class="relative pl-16">
                    <dt class="text-base font-semibold leading-7 text-gray-900">
                      <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-primary">
                        <component :is="feature.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                      </div>
                      {{ feature.name }}
                    </dt>
                    <dd class="mt-2 text-base leading-7 text-gray-600">{{ feature.description }}</dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
      </div>
        <div class="mx-auto mt-20 max-w-7xl px-6 sm:mt-56 lg:py-10 lg:px-8">
          <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-64 lg:max-w-4xl">
            <div class="w-full">
              <h2 class="text text-center text-5xl font-bold mb-10 text-primary">Cursos Disponíveis</h2>
              <hr class="my-8 border-t-4 w-1/4 border-primary mx-auto rounded-full">
              <div class="flex justify-between ">
                <div v-for="(curso, index) in cursos" :key="index" class="text mt-9 w-1/3 p-4 cursor-pointer transition-transform ease-in-out transform hover:scale-105">
                  <div class="bg-white hover:bg-primary border-primary/10 hover:text-white  rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold mb-2">{{ curso.titulo }}</h3>
                    <p>{{ curso.descricao }}</p>
                    <p class="mt-4 text-gray-500 text-sm">{{ curso.duracao }}</p>
                    <secondary-button class="mt-5">Inscrever-se</secondary-button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>

      <!-- Footer -->
      <div class="mx-auto mt-32 max-w-7xl px-6 lg:px-8 bg-secondary">
        <footer aria-labelledby="footer-heading" class="relative border-t border-gray-900/10 py-24 sm:mt-56 sm:py-32">
          <h2 id="footer-heading" class="sr-only">Footer</h2>
          <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <img class="h-7" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Company name" />
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-primary">Solutions</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li v-for="item in footerNavigation.solutions" :key="item.name">
                      <a :href="item.href" class="text-sm leading-6 text-white hover:text-altern">{{ item.name }}</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-primary">Support</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li v-for="item in footerNavigation.support" :key="item.name">
                      <a :href="item.href" class="text-sm leading-6 text-white hover:hover:text-altern">{{ item.name }}</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-primary">Company</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li v-for="item in footerNavigation.company" :key="item.name">
                      <a :href="item.href" class="text-sm leading-6 text-white hover:hover:text-altern">{{ item.name }}</a>
                    </li>
                  </ul>
                </div>
                <div class="mt-10 md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-primary">Legal</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li v-for="item in footerNavigation.legal" :key="item.name">
                      <a :href="item.href" class="text-sm leading-6 text-white hover:hover:text-altern">{{ item.name }}</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    </div>
</template>

<style>

</style>
