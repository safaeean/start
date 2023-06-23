<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="permission.guard_name" type="text" :label="t('table.column.permission_guard_name')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="permission.name" type="text" :label="t('table.column.permission_name')"/>
        </div>
      </div>


      <div class="form-section">
        <el-button native-type="submit">{{ t('save') }}</el-button>
      </div>
    </form>
  </div>
</template>

<script setup>

import {getCurrentInstance, ref} from 'vue'
import {useRouter} from 'vue-router';
import {useToast} from "vuestic-ui";
import {useI18n} from "vue-i18n";

const router = useRouter()
const {init} = useToast()
const { t } = useI18n()
const props = defineProps(["permission"])


const permission = ref({})

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


if (props.permission) {
  globalProperties.$httpGet("/api/admin/permission/" + props.permission, function (data) {
    permission.value = data.permission;
  })
}


function handleSubmit() {
  globalProperties.$httpPost("/api/admin/permission", props.permission, {permission: permission.value}, function (data) {
    init({
      message: data.message
    })
  });
}
</script>

