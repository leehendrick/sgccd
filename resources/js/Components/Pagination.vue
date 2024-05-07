<script setup>
  defineProps({
    links: Array
  })
</script>

<template>
          <Component
              :is="link.url ? 'a' : 'span'"
              v-for="(link, index) in links"
              :key="index"
              :href="link.url"
              v-html="link.label"
              :class="{
                'text-gray-500': !link.url,
                'font-bold text-primary': link.active
              }"
              class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium hover:border-primary hover:text-gray-700"
          />
</template>

<style scoped>

</style>