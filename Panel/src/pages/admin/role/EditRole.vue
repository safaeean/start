<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('roles.editRole') }}</va-card-title>
      <va-card-content>
        <role-fields :role="route.params.role"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import RoleFields from "./RoleFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
