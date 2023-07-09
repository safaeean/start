<template>
  <section id="services">
    <div class="container">
      test
    </div><!--/.container-->
  </section><!--/#services-->
</template>

<script>
export default {
  name: 'IndexPage',
  data () {
    return {
      config: {}
    }
  },
  head () {
    return {
      title: this.config.name + ' | ' + this.config.title
    }
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  }
}
</script>
