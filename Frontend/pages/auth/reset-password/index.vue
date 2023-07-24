<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="reset" class="form-horizontal">
        <div class="mb-3">
          <label for="email">{{ $t('Email') }} :</label>
          <input type="email" class="form-control" id="email" v-model="email" required>
        </div>
        <div>
          <button type="submit" class="btn btn-success">{{ $t('Send me reset password instructions') }}</button>
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
      email: '',
      password: ''
    }
  },
  methods: {
    reset () {
      this.$nuxt.$loading.start()
      axios.post('/api/password/email', {
        email: this.email
      }).then(function (data) {
        Swal({
          title: 'Success!',
          text: data.data.message,
          icon: 'success',
          confirmButtonText: 'Cool'
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
