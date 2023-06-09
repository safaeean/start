<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="login" class="form-horizontal">
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password :</label>
          <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Login</button>
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
      email: '',
      password: ''
    }
  },
  methods: {
    login () {
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
