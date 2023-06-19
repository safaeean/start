<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="post.title" type="text" :label="t('table.column.title')" />
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="post.description" type="text" :label="t('table.column.description')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-input v-model="post.content" type="textarea" :label="t('table.column.content')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-select
            v-model="post.category_id"
            :options="categoriesList"
            key-by="id"
            value-by="id"
            text-by="title"
            :label="t('table.column.category_id')"
            searchable
            clearable
            class="mb-3"
          />
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

const props = defineProps(["post"])


const post = ref({})

import {getCurrentInstance} from 'vue'
import {useToast} from "vuestic-ui";

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


if (props.post) {
  globalProperties.$httpGet("/api/admin/blog/post/" + props.post, function (data) {
    post.value = data.post;
  })
}
const {init} = useToast()

const categoriesList = ref();
globalProperties.$httpGet("/api/admin/blog/category", function (data) {
  categoriesList.value = data.data;
})

function handleSubmit() {
  globalProperties.$httpPost("/api/admin/blog/post", props.post, {post: post.value}, function (data) {
    init({
      message: data.message
    })
  });
}


</script>
