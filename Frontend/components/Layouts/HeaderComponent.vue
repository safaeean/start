<template>
  <nav id="main-nav" class="navbar navbar-expand-lg navbar-default bg-dark border-bottom border-bottom-dark"
       data-bs-theme="dark">
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
        <span class="navbar-toggler-icon"/>
      </button>
      <div id="navbarTogglerDemo01" class="collapse navbar-collapse">
        <NuxtLink class="navbar-brand" :to="localePath('/')">
          <img :src="config.logo || `~/assets/images/logo.png`" class="logo" alt="logo">
        </NuxtLink>
        <ul class="navbar-nav mb-2 mb-lg-0" :class="$i18n.localeProperties.dir === 'rtl' ? 'ms-auto' : 'me-auto'">
          <li class="nav-item">
            <NuxtLink class="nav-link" :to="localePath('/')">
              {{ $t("Home") }}
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink class="nav-link" :to="localePath('/blog')">
              {{ $t("Blog") }}
            </NuxtLink>
          </li>
          <client-only>
            <li v-if="!$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" :to="localePath('/auth/register')">
                {{ $t("Register") }}
              </NuxtLink>
            </li>
            <li v-if="!$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" :to="localePath('/auth/login')">
                {{ $t("Login") }}
              </NuxtLink>
            </li>
            <li v-if="$auth.loggedIn" class="nav-item">
              <NuxtLink class="nav-link" :to="localePath('/profile')">
                {{ $t("Profile") }}
              </NuxtLink>
            </li>
            <li v-if="$auth.loggedIn && $auth.$state.user.is_admin" class="nav-item">
              <a class="nav-link" href="/admin/dashboard">
                {{ $t("Admin Panel") }}
              </a>
            </li>
          </client-only>
        </ul>
        <li class="nav-item dropdown float-end">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $t("Switch Language") }}
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li v-for="locale in availableLocales"
                :key="locale.code">
              <nuxt-link :to="switchLocalePath(locale.code)" class="dropdown-item">{{ locale.name }}</nuxt-link>
            </li>
          </ul>
        </li>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" :placeholder="$t('search')" :aria-label="$t('search')">
          <button class="btn btn-outline-success" type="submit">
            {{ $t('search') }}
          </button>
        </form>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  computed: {
    availableLocales() {
      return this.$i18n.locales.filter(i => i.code !== this.$i18n.locale)
    }
  },
  data() {
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
