<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-content>
        <Table api="/admin/blog/category" :columns="columns" :features_buttons="buttons"/>
      </va-card-content>
    </va-card>
  </div>
</template>
<script setup lang="ts">
import Table from "../../../../components/Table.vue";
import {useI18n} from "vue-i18n";
const { t } = useI18n()
const columns = [
  {
    title: t('table.column.title'),
    data: "id"
  },
  {
    title: t('table.column.title'),
    data: "title"
  },
  {
    title: t('table.column.creationDate'),
    data: "created_at"
  }
]
const buttons = [
  {
    title: t('categories.createCategory'),
    link: "/admin/blog/category/create"
  }
]
</script>
