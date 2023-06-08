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
import axios from 'axios';
import Swal from 'sweetalert'

export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    login() {
      axios.post('/api/login', {
        email: this.email,
        password: this.password
      }).then(function (data) {
        Swal({
          title: 'Success!',
          text: data.message,
          icon: 'success',
          confirmButtonText: 'Cool'
        })
      }).catch(function (data) {
        data.response.data.errors.forEach(function (error) {
          Swal({
            title: 'Error!',
            text: error,
            icon: 'error',
            confirmButtonText: 'Cool'
          })
        })
      })
    },
  },
};
</script>