<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="reset" class="form-horizontal">
        <div class="mb-3">
          <label for="token">{{ $t('Token') }} :</label>
          <input id="token" v-model="token" class="form-control" readonly required>
        </div>
        <div class="mb-3">
          <label for="email">{{ $t('Email') }} :</label>
          <input id="token" v-model="email" class="form-control" readonly required>
        </div>
        <div class="mb-3">
          <label for="password">{{ $t('New password') }} :</label>
          <input id="token" v-model="password" class="form-control" type="password" required>
        </div>
        <div class="mb-3">
          <label for="password_confirmation">{{ $t('Confirm password') }} :</label>
          <input id="password_confirmation" v-model="password_confirmation" class="form-control" type="password" required>
        </div>
        <div>
          <button type="submit" class="btn btn-success">{{ $t('Update account password') }}</button>
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
      config: {},
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
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  },
  head () {
    return {
      title: this.config.name + ' | ' + this.$t('Reset password')
    }
  }

}
</script>
