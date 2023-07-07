<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="reset" class="form-horizontal">
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" v-model="email" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Send me reset password instructions</button>
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
  }
}
</script>
