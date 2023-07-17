<template>
  <section id="services">
    <div class="container">
      <h1>{{ post.title }}</h1>
      <hr>
      {{ post.content }}
    </div><!--/.container-->
  </section><!--/#services-->
</template>

<script>
export default {
  name: 'BlogPage',
  props: ['slug'],
  data: () => {
    return {
      config: {},
      post: {}
    }
  },
  head () {
    return {
      title: this.post.title + ' | ' + this.config.title,
      meta: [
        // hid is used as unique identifier. Do not use `vmid` for it as it will not work
        {
          hid: 'description',
          name: 'description',
          content: this.post.description
        }
      ]
    }
  },
  async fetch () {
    this.post = await this.$axios.$get(`/api/blog/post/${this.$route.params.slug}`)
    this.config = await this.$axios.$get('/api/config')
  }
}
</script>
