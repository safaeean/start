<template>
  <div class="flex">
    <va-card class="flex mb-4">
      <va-card-content>
        <Table api="/admin/role" :columns="columns" :features_buttons="features_buttons"/>
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
    title: t('table.column.role_guard_name'),
    data: "guard_name"
  },
  {
    title: t('table.column.role_name'),
    data: "name"
  }
]

const features_buttons = [
  {
    title: t('roles.createRole'),
    link: "/admin/role/create"
  }
]
</script>
