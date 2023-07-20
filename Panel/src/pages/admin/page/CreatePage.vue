<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('pages.createPage') }}</va-card-title>
      <va-card-content>
        <page-fields/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import PageFields from "./PageFields.vue";

import {useI18n} from "vue-i18n";

const {t} = useI18n()

</script>
