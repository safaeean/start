<template>
  <header id="header">
    <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <NuxtLink class="navbar-brand" to="/"><img src="~/assets/images/logo.png" alt="logo"></NuxtLink>
        </div>

        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><NuxtLink to="/">Home</NuxtLink></li>
            <li><NuxtLink to="/contact-us">Contact us</NuxtLink></li>
            <li><NuxtLink to="/auth/register">Register</NuxtLink></li>
            <li><NuxtLink to="/auth/login">Login</NuxtLink></li>
          </ul>
        </div>
      </div><!--/.container-->
    </nav><!--/nav-->
  </header><!--/header-->
</template>
<style>
.collapse {
  visibility: inherit!important;
}
</style>
<style>
@import "@/assets/css/main.css";
</style>
