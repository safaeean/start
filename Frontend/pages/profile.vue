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
          <button class="btn btn-danger" type="button" @click="logout">Logout</button>
          <button v-if="!user.email_verified_at" class="btn btn-info" type="button" @click="sendEmailVerification">Send email verification</button>
        </div>
      </div>
    </client-only>
  </section>
</template>

<script>
import Swal from 'sweetalert'
import axios from 'axios'

export default {
  data () {
    return {
      config: {},
      user: this.$auth.user
    }
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  },
  methods: {
    logout () {
      this.$auth.logout().then(function () {
        window.location.replace('/')
      })
    },
    sendEmailVerification () {
      axios.post('/api/email/verify/resend').then(function (data) {
        console.log(data)
        Swal({
          title: 'Success!',
          text: data.data.status,
          icon: 'success',
          confirmButtonText: 'Cool'
        })
      })
    }
  },
  head () {
    return {
      title: this.config.name + ' | Profile'
    }
  }
}
</script>
