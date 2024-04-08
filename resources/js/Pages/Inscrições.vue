<script setup>
import {Link} from "@inertiajs/vue3";
import LandingHeader from "@/Components/LandingHeader.vue";
</script>

<template>
  <landing-header :canLogin="$page.props.canLogin" :canRegister="$page.props.canRegister" :laravelVersion="$page.props.laravelVersion" :phpVersion="$page.props.phpVersion" />
</template>

<style scoped>

</style>