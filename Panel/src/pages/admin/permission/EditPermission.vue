<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('permissions.editPermission') }}</va-card-title>
      <va-card-content>
        <permission-fields :permission="route.params.permission"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import PermissionFields from "./PermissionFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
