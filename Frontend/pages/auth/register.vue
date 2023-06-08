<template>
  <section id="services">
    <div class="container">
      <form @submit.prevent="register" class="form-horizontal">
        <div class="form-group">
          <label for="name">Name :</label>
          <input type="text" class="form-control" id="name" v-model="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" id="email" v-model="email" required>
        </div>
        <div class="form-group">
          <label for="password">Password :</label>
          <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm password :</label>
          <input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation"
                 required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Register</button>
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
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    };
  },
  methods: {
    register() {
      axios.post('/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation
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