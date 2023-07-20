<template>
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          &copy; {{ new Date().getFullYear() }} {{ config.name }}.
        </div>
        <div class="col-sm-6">
          <ul class="social-icons" :class="this.$i18n.localeProperties.dir === 'rtl' ? 'float-start' : ''">
            <li><a href="#"><i class="fa fa-facebook" /></a></li>
            <li><a href="#"><i class="fa fa-twitter" /></a></li>
            <li><a href="#"><i class="fa fa-google-plus" /></a></li>
            <li><a href="#"><i class="fa fa-linkedin" /></a></li>
            <li><a href="#"><i class="fa fa-youtube" /></a></li>
            <li><a href="#"><i class="fa fa-github" /></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer><!--/#footer-->
</template>
<script>
export default {
  data: () => {
    return {
      config: {}
    }
  },
  async fetch () {
    this.config = await this.$axios.$get('/api/config')
  }
}
</script>
