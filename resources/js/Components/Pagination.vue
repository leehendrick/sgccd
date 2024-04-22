<script setup>
  defineProps({
    links: Array
  })
</script>

<template>
  <div>
    <Component
        :is="link.url ? 'Link' : 'span'"
        v-for="link in links"
        :href="link.url"
        v-html="link.label"
        :class="{
          'text-gray-500' : !link.url,
          'font-bold bg-primary text-gray-200': link.active
        }"
        class="px-1"
    />
  </div>
</template>

<style scoped>

</style>