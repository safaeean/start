<template>
  <header id="header">
    <nav id="main-nav" class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar" />
            <span class="icon-bar" />
            <span class="icon-bar" />
          </button>
          <NuxtLink class="navbar-brand" to="/">
            <img src="~/assets/images/logo.png" alt="logo">
          </NuxtLink>
        </div>

        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <client-only>
              <li>
                <NuxtLink to="/">
                  Home
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/blog">
                  Blog
                </NuxtLink>
              </li>
              <li v-if="!$auth.loggedIn">
                <NuxtLink to="/auth/register">
                  Register
                </NuxtLink>
              </li>
              <li v-if="!$auth.loggedIn">
                <NuxtLink to="/auth/login">
                  Login
                </NuxtLink>
              </li>
              <li v-if="$auth.loggedIn">
                <NuxtLink to="/profile">
                  {{ $auth.$state.user.name }}
                </NuxtLink>
              </li>
              <li v-if="$auth.loggedIn && $auth.$state.user.is_admin">
                <a href="/admin/dashboard">
                  Admin Panel
                </a>
              </li>
            </client-only>
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
</template>
<script>
export default {
  data () {
    return {
      user: this.$auth.user
    }
  }
}
</script>
<style>
.collapse {
  visibility: inherit!important;
}
</style>
<style>
@import "@/assets/css/main.css";
</style>
