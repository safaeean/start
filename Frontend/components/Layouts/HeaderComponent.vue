<template>
  <nav id="main-nav" class="navbar navbar-expand-lg navbar-default bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
    <div class="container">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon" />
      </button>
      <div id="navbarTogglerDemo01" class="collapse navbar-collapse">
        <NuxtLink class="navbar-brand" to="/">
          <img :src="config.logo || `~/assets/images/logo.png`" class="logo" alt="logo">
        </NuxtLink>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <NuxtLink class="nav-link" to="/">
              Home
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink class="nav-link" to="/blog">
              Blog
            </NuxtLink>
          </li>
          <client-only>
            <li v-if="!$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" to="/auth/register">
                Register
              </NuxtLink>
            </li>
            <li v-if="!$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" to="/auth/login">
                Login
              </NuxtLink>
            </li>
            <li v-if="$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" to="/profile">
                {{ $auth.$state.user.name }}
              </NuxtLink>
            </li>
            <li v-if="$auth.loggedIn && $auth.$state.user.is_admin" class="nav-item">
              <a href="/admin/dashboard">
                Admin Panel
              </a>
            </li>
          </client-only>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  data () {
    return {
      user: this.$auth.user,
      config: {}
    }
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  }
}
</script>
<style>
.collapse {
  visibility: inherit !important;
}
</style>
<style>
@import "@/assets/css/main.css";
</style>
