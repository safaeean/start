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
      post: {}
    }
  },
  async fetch () {
    this.post = await this.$axios.$get(`/api/blog/post/${this.$route.params.slug}`)
  }
}
</script>
