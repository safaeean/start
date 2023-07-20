<template>
  <section id="services">
    <div class="container">
      <div class="row">
        <Post v-for="post in posts.data" :key="post.id" :post="post" />
      </div>
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
      config: {},
      posts: []
    }
  },
  async fetch () {
    this.posts = await this.$axios.$get('/api/blog/posts')
    this.config = await this.$axios.$get('/api/config')
  },
  head () {
    return {
      title: this.config.name + ' | Blog',
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
