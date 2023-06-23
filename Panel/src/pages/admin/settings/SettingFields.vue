<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="setting.name" type="text" :label="t('table.column.websiteName')" />
        </div>
      </div>

      <div class="row">
        <div class="flex md12">
          <va-input v-model="setting.title" type="text" :label="t('table.column.websiteTitle')" />
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="setting.description" type="text" :label="t('table.column.websiteDescription')" />
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="setting.color" type="color" :label="t('table.column.websiteColor')" />
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="setting.secondary_color" type="color" :label="t('table.column.websiteSecondaryColor')" />
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
const { t } = useI18n()

const router = useRouter()

const props = defineProps(["user"])


const setting = ref({})

import {getCurrentInstance} from 'vue'
import {useToast} from "vuestic-ui";

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


globalProperties.$httpGet("/api/admin/setting/", function (data) {
  setting.value = data.setting;
})
const {init} = useToast()

function handleSubmit() {
  globalProperties.$httpPost("/api/admin/setting", setting.value.id , {setting: setting.value}, function (data) {
    init({
      message: data.message
    })
  });
}


</script>
