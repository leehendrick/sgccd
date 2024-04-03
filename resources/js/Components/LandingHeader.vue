<script setup>

import {Bars3Icon, XMarkIcon} from "@heroicons/vue/24/outline/index.js";
import {Dialog, DialogPanel} from "@headlessui/vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";

const navigation = [
  {name: 'Home', href: '#'},
  {name: 'Inscrições', href: '#'},
  {name: 'Contatos', href: '#'},
  {name: 'LabPro', href: '#'},
]

const mobileMenuOpen = ref(false)

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
</script>

<template>
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

</template>

<style scoped>

</style>