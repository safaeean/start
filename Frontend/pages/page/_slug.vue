<template>
  <section id="services">
    <div class="container" v-html="page.content"></div>
  </section><!--/#services-->
</template>

<script>
export default {
  name: 'BlogPage',
  props: ['slug'],
  data: () => {
    return {
      config: {},
      page: {}
    }
  },
  async fetch () {
    try {
      this.page = await this.$axios.$get(`/api/page/${this.$route.params.slug}`)
    } catch (error) {
      this.$nuxt.context.error({
        status: 404,
        message: 'Page not found'
      })
    }
    this.config = await this.$axios.$get('/api/config')
  },
  head () {
    return {
      title: this.config.name + ' | ' + this.page.title,
      meta: [
        // hid is used as unique identifier. Do not use `vmid` for it as it will not work
        {
          hid: 'description',
          name: 'description',
          content: this.page.description
        }
      ]
    }
  }
}
</script>
