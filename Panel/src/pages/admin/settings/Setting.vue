<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-title>{{ t('settings.settings') }}</va-card-title>
      <va-card-content>
        <setting-fields/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import SettingFields from "./SettingFields.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n()
</script>
