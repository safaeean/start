<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('pages.editPage') }}</va-card-title>
      <va-card-content>
        <page-fields :page="route.params.page"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import PageFields from "./PageFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
