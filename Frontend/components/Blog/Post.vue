<template>
  <div class="card col-md-4">
    <div class="card-body">
      <h5 class="card-title">{{ post.title }}</h5>
      <p class="card-text">{{ post.content }}</p>
      <NuxtLink :to="`/blog/post/${post.id}`" class="btn btn-primary">Go somewhere</NuxtLink>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Post',
  props: ['post']
}
</script>
