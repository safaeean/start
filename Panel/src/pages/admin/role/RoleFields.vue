<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="role.guard_name" type="text" :label="t('table.column.role_guard_name')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="role.name" type="text" :label="t('table.column.role_name')"/>
        </div>
      </div>

      <div class="row">
        <div class="flex md12">
          <va-select v-model="role.permissions"
                     key-by="id"
                     value-by="id"
                     text-by="name"
                     multiple :label="t('table.column.permissions')" :options="permissions"/>
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

const props = defineProps(["role"])
const { t } = useI18n()

const permissions = ref({})

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


globalProperties.$httpGet("/api/admin/permission", function (data) {
  permissions.value = data.data;
})


const role = ref({})


if (props.role) {

  globalProperties.$httpGet("/api/admin/role/" + props.role, function (data) {
    role.value = data.role;
  })

}
const {init} = useToast()

function handleSubmit() {
  globalProperties.$httpPost("/api/admin/role", props.role, {role: role.value}, function (data) {
    init({
      message: data.message
    })
  });
}
</script>
