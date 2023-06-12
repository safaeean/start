<template>
  <section id="services">
    <client-only>
      <div class="container" v-if="user">
        <div class="form-group">
          <label for="name">Name :</label>
          <input type="text" class="form-control" id="name" v-model="user.name" required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" v-model="user.email" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Register</button>
        </div>
      </div>
    </client-only>
  </section>
</template>

<script>
export default {
  data () {
    return {
      user: this.$auth.user
    }
  }
}
</script>
