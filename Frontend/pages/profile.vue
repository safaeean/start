<template>
  <section id="services">
    <client-only>
      <div v-if="user" class="container">
        <div class="form-group">
          <label for="name">Name :</label>
          <input id="name" v-model="user.name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Update Profile</button>
          <button class="btn btn-danger" type="submit" @click="logout">Logout</button>
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
  },
  methods: {
    logout () {
      this.$auth.logout().then(function () {
        window.location.replace('/')
      })
    }
  }
}
</script>
