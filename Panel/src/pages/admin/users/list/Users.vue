<template>
  <Table api="/admin/user" :columns="columns" :buttons="buttons"/>
</template>
<script setup lang="ts">
import Table from "../../../../components/Table.vue";
const columns = [
  {
    title: "Id",
    data: "id"
  },
  {
    title: "Name",
    data: "name"
  },
  {
    title: "Registration date",
    data: "created_at"
  }
]
const buttons = [
  {
    title: "Report",
    link: "report",
    type: "info"
  }
]
</script>
