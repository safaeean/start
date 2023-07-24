<template>
  <section id="services">
    <div class="container">
      <form class="form-horizontal" @submit.prevent="login">
        <div class="mb-3">
          <label class="form-label" for="email">{{ $t('Email') }} :</label>
          <input id="email" v-model="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">{{ $t('Password') }} :</label>
          <input id="password" v-model="password" type="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-success">
            {{ $t('Login') }}
          </button>
          <nuxt-link :to="localePath('/auth/reset-password')">
            {{ $t('I forgot my password') }}
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
      title: this.config.name + ' | ' + this.$t('Login')
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
