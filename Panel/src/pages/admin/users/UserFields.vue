<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="user.name" type="text" :label="t('table.column.name')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="user.email" type="email" :label="t('table.column.email')"/>
        </div>
      </div>

      <div class="row">
        <div class="flex md12">
          <va-select v-model="user.roles"
                     key-by="id"
                     value-by="id"
                     text-by="name"
                     multiple :label="t('table.column.roles')" :options="roles"/>
        </div>
      </div>

      <el-button native-type="submit">{{ t('save') }}</el-button>
    </form>
  </div>
</template>

<script setup>

import {ref} from 'vue'
import {useRouter} from 'vue-router';

import {useI18n} from "vue-i18n";

const {t} = useI18n()

const router = useRouter()

const props = defineProps(["user"])


const user = ref({})

import {getCurrentInstance} from 'vue'
import {useToast} from "vuestic-ui";


const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


const roles = ref({})
globalProperties.$httpGet("/api/admin/role", function (data) {
  roles.value = data.data;
})

if (props.user) {
  globalProperties.$httpGet("/api/admin/user/" + props.user, function (data) {
    user.value = data.user;
  })
}
const {init} = useToast()

function handleSubmit() {
  globalProperties.$httpPost("/api/admin/user", props.user, {user: user.value}, function (data) {
    init({
      message: data.message
    })
  });
}


</script>
