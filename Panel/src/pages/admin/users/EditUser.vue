<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('users.editUser') }}</va-card-title>
      <va-card-content>
        <user-fields :user="route.params.user"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import UserFields from "./UserFields.vue";
import {useRoute} from "vue-router";

import {useI18n} from "vue-i18n";
const { t } = useI18n()

const route = useRoute();
</script>
