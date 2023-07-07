<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="reset" class="form-horizontal">
        <div class="form-group">
          <label for="token">Token :</label>
          <input id="token" v-model="token" class="form-control" readonly required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input id="token" v-model="email" class="form-control" readonly required>
        </div>
        <div class="form-group">
          <label for="password">New password :</label>
          <input id="token" v-model="password" class="form-control" type="password" required>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm password :</label>
          <input id="password_confirmation" v-model="password_confirmation" class="form-control" type="password" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Update account password</button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import Swal from 'sweetalert'
import axios from 'axios'

export default {
  data () {
    return {
      token: this.$route.params.token,
      email: this.$route.params.email,
      password: '',
      password_confirmation: ''
    }
  },
  methods: {
    reset () {
      const self = this
      this.$nuxt.$loading.start()
      axios.post('/api/password/reset', {
        token: this.token,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      }).then(function (data) {
        Swal({
          title: 'Success!',
          text: data.data.message,
          icon: 'success',
          confirmButtonText: 'Cool'
        }).then(function () {
          self.$auth.loginWith('laravelSanctum', {
            data: {
              email: self.email,
              password: self.password
            }
          }).then(function (data) {
            window.location.replace('/')
          })
        })
      }).catch(function (data) {
        if (data.response.data.message) {
          Swal({
            title: 'Error!',
            text: data.response.data.message,
            icon: 'error',
            confirmButtonText: 'Cool'
          })
        } else {
          Swal({
            title: 'Error!',
            text: 'Error',
            icon: 'error',
            confirmButtonText: 'Cool'
          })
        }
      })
      this.$nuxt.$loading.finish()
    }
  }
}
</script>
