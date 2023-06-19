<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('categories.editCategory') }}</va-card-title>
      <va-card-content>
        <category-fields :category="route.params.category"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import CategoryFields from "./CategoryFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
