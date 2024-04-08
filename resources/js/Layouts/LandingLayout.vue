<script setup>

import LandingHeader from "@/Components/LandingHeader.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
  <landing-header :canLogin="$page.props.canLogin" :canRegister="$page.props.canRegister" :laravelVersion="$page.props.laravelVersion" :phpVersion="$page.props.phpVersion" />
  <slot/>
  <Footer/>
</template>

<style scoped>

</style>