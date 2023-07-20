<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="page.title" type="text" :label="t('table.column.title')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="page.slug" dir="ltr" type="text" :label="t('table.column.slug')">
            <template #append>
              <span dir="ltr" style="padding-top: 12px;"><span v-text="pages_url_prefix"></span>/page/</span>
            </template>
          </va-input>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="page.description" type="text" :label="t('table.column.description')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <ck-editor
            :lang="t('lang')"
            :value="page.content"
            @change="page.content = $event.data"
          ></ck-editor>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-checkbox v-model="page.active" :label="t('table.column.active')"/>
        </div>
      </div>


      <div class="form-section">
        <el-button native-type="submit">{{ t('save') }}</el-button>
      </div>
    </form>
  </div>
</template>

<script setup>

import {getCurrentInstance, reactive, watch} from 'vue'
import {useRouter} from 'vue-router';
import {useToast} from "vuestic-ui";
import {useI18n} from "vue-i18n";

const router = useRouter()
const {init} = useToast()
const { t } = useI18n()
const props = defineProps(["page"])

import CkEditor from "../../../components/CKEditor.vue";
const page = reactive({title: ""})

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties

const pages_url_prefix = window.location.origin;

if (props.page) {
  globalProperties.$httpGet("/api/admin/page/" + props.page, function (data) {
    Object.assign(page , data.page)
  })
}else{
  watch(() => page.title, function (value , old) {
    if(page && value !== old)
      page.slug = page.title.replaceAll(" ", "_");
  })
}



function handleSubmit() {
  globalProperties.$httpPost("/api/admin/page", props.page, {page: page}, function (data) {
    init({
      message: data.message
    })
  });
}
</script>

