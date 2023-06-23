<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('roles.createRole') }}</va-card-title>
      <va-card-content>
        <role-fields/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import RoleFields from "./RoleFields.vue";

import {useI18n} from "vue-i18n";

const {t} = useI18n()

</script>
