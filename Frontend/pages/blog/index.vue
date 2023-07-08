<template>
  <section id="services">
    <div class="container">
      <Post v-for="post in posts.data" :key="post.id" :post="post" />
    </div><!--/.container-->
  </section><!--/#services-->
</template>

<script>


import Post from '../../components/Blog/Post.vue'

export default {
  name: 'BlogPage',
  components: { Post },
  data: () => {
    return {
      posts: []
    }
  },
  async fetch () {
    this.posts = await this.$axios.$get('/api/blog/posts')
  }
}
</script>
