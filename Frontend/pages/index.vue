<template>
  <section id="services">
    <div class="container" v-html="page.content"></div><!--/.container-->
  </section><!--/#services-->
</template>

<script>
export default {
  name: 'IndexPage',
  data () {
    return {
      config: {},
      page: {},
    }
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
    try {
      this.page = await this.$axios.$get('/api/page/home')
    } catch (e) {
      this.page = {
        content: 'You can create a page with the slug \'home\' and edit this page through the admin panel.'
      }
    }
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
