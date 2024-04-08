<script setup>
import {Head} from '@inertiajs/vue3';
import {ref, onMounted} from 'vue'
import {
  AcademicCapIcon,
  BookOpenIcon,
  BuildingOffice2Icon,
  CheckBadgeIcon,

} from '@heroicons/vue/20/solid'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import LandingHeader from "@/Components/LandingHeader.vue";

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

onMounted(() => {

});
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
          <landing-header :canLogin="$page.props.canLogin" :canRegister="$page.props.canRegister" :laravelVersion="$page.props.laravelVersion" :phpVersion="$page.props.phpVersion" />
        </div>
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
                    <div class="bg-white hover:bg-primary hover:text-white rounded-lg shadow-md p-6">
                      <h3 class="text-lg font-bold mb-2">{{ curso.titulo }}</h3>
                      <p class="text-sm">{{ curso.descricao }}</p>
                      <p class="mt-4 text-gray-500 text-sm">{{ curso.duracao }}</p>
                      <secondary-button class="mt-5">Inscrever-se</secondary-button>
                    </div>
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
