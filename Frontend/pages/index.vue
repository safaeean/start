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
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  },
  head () {
    return {
      title: this.config.name + ' | ' + this.config.title,
      meta: [
        // hid is used as unique identifier. Do not use `vmid` for it as it will not work
        {
          hid: 'description',
          name: 'description',
          content: this.config.description
        }
      ]
    }
  }
}
</script>
