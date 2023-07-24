<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="register" class="form-horizontal">
        <div class="mb-3">
          <label for="name">{{ $t('Name')}} :</label>
          <input type="text" class="form-control" id="name" v-model="name" required>
        </div>
        <div class="mb-3">
          <label for="email">{{ $t('Email')}} :</label>
          <input type="email" class="form-control" id="email" v-model="email" required>
        </div>
        <div class="mb-3">
          <label for="password">{{ $t('Password')}} :</label>
          <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation">{{ $t('Confirm password')}} :</label>
          <input type="password"
                 class="form-control"
                 id="password_confirmation"
                 v-model="password_confirmation"
                 required>
        </div>
        <div>
          <button type="submit" class="btn btn-success">{{ $t('Register')}}</button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert'

export default {
  data () {
    return {
      config: {},
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }
  },
  methods: {
    register () {
      const self = this
      this.$nuxt.$loading.start()
      axios.post('/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
      }).then(function (data) {
        self.$auth.loginWith('laravelSanctum', {
          data: {
            email: self.email,
            password: self.password
          }
        }).then(function (data) {
          window.location.replace('/')
        }).catch(function (data) {
          Swal({
            title: 'Error!',
            text: data.response.data.message,
            icon: 'error',
            confirmButtonText: 'Cool'
          })
        })
      }).catch(function (data) {
        console.log(data)
        if (data.response.errors){
          data.response.errors.forEach(function (error) {
            Swal({
              title: 'Error!',
              text: error,
              icon: 'error',
              confirmButtonText: 'Cool'
            })
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
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  },
  head () {
    return {
      title: this.config.name + ' | ' + this.$t('Register')
    }
  }
}
</script>
