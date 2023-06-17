<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('posts.editPost') }}</va-card-title>
      <va-card-content>
        <post-fields :post="route.params.post"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import PostFields from "./PostFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
