<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-content>
        <Table api="/admin/page" :columns="columns" :features_buttons="features_buttons"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import Table from "../../../components/Table.vue";

import {useI18n} from "vue-i18n";

const {t} = useI18n()

const columns = [
  {
    title: t('table.column.id'),
    data: "id"
  },
  {
    title: t('table.column.title'),
    data: "title"
  },
  {
    title: t('table.column.description'),
    data: "description"
  }
]

const features_buttons = [
  {
    title: t('pages.createPage'),
    link: "/admin/page/create"
  }
]
</script>
