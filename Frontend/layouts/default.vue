<template>
  <div class="main-container" :dir="$i18n.localeProperties.dir">
    <header-component />
    <Nuxt />
    <footer-component />
  </div>
</template>
<script setup>
import HeaderComponent from '~/components/Layouts/HeaderComponent.vue'
import FooterComponent from '~/components/Layouts/FooterComponent.vue'
</script>
