<script setup>
const footerNavigation = {
  solutions: [
    {name: 'Fazer Inscrição', href: '#'},

  ],
  support: [
    {name: 'example@lab.co.ao', href: '#'},
    {name: '+244 987 123 456', href: '#'},
    {name: '1230 Maecenas Street Donec Road\n' +
          '\n' +
          'New York, EEUU', href: '#'},
  ],
  company: [
    {name: 'About', href: 'https://www.isptec.co.ao/laboratorios-profissionalizantes/'},
    {name: 'Isptec', href: 'https://www.isptec.co.ao/'},

  ],
}

</script>

<template>
  <!-- Footer -->
    <footer aria-labelledby="footer-heading" class="relative bg-secondary border-t border-gray-900/10 py-24 sm:mt-56 sm:py-32">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <h2 id="footer-heading" class="sr-only">Footer</h2>
      <div class="xl:grid xl:grid-cols-3 xl:gap-8">
        <img class="h-7" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Company name" />
        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-primary">Inscrições</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li
                    v-for="item in footerNavigation.solutions"
                    :key="item.name"
                >
                  <a
                      :href="item.href"
                      class="text-sm leading-6 text-white hover:text-altern">{{ item.name }}</a>
                </li>
              </ul>
            </div>
            <div class="mt-10 md:mt-0">
              <h3 class="text-sm font-semibold leading-6 text-primary">Contatos</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li
                    v-for="item in footerNavigation.support"
                    :key="item.name">
                  <a :href="item.href" class="text-sm leading-6 text-white hover:hover:text-altern">{{ item.name }}</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-primary">LabPro</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li
                    v-for="item in footerNavigation.company"
                    :key="item.name">
                  <a :href="item.href" class="text-sm leading-6 text-white hover:hover:text-altern">{{ item.name }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      </div>
    </footer>

</template>

<style scoped>

</style>