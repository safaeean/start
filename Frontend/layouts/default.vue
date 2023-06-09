<template>
  <div>
    <div>
      <div>
        <div class="main-container">
          <header-component />
          <Nuxt />
          <footer-component />
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import HeaderComponent from '~/components/Layouts/HeaderComponent.vue'
import FooterComponent from '~/components/Layouts/FooterComponent.vue'
</script>
