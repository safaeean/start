<template>
  <section id="services">
    <div class="container">
      <form class="form-horizontal" @submit.prevent="login">
        <div class="mb-3">
          <label class="form-label" for="email">Email :</label>
          <input id="email" v-model="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">Password :</label>
          <input id="password" v-model="password" type="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success">
            Login
          </button>
          <nuxt-link to="/auth/reset-password">
            I forgot my password
          </nuxt-link>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import Swal from 'sweetalert'

export default {
  data () {
    return {
      config: {},
      email: '',
      password: ''
    }
  },
  async fetch() {
    this.config = await this.$axios.$get('/api/config')
  },
  head() {
    return {
      title: this.config.name + ' | Login'
    }
  },
  methods: {
    login() {
      this.$nuxt.$loading.start()
      this.$auth.loginWith('laravelSanctum', {
        data: {
          email: this.email,
          password: this.password
        }
      }).then(function (data) {
        window.location.replace('/')
      }).catch(function (data) {
        console.log(data)
        Swal({
          title: 'Error!',
          text: data.response.data.message,
          icon: 'error',
          confirmButtonText: 'Cool'
        })
      })
      this.$nuxt.$loading.finish()
    }
  }
}
</script>
