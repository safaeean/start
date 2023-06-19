<template>
  <div class="container">
    <form @submit.prevent="handleSubmit" class="checkout-form">
      <div class="row">
        <div class="flex md12">
          <va-input v-model="category.title" type="text" :label="t('table.column.title')"/>
        </div>
      </div>
      <div class="row">
        <div class="flex md12">
          <va-select
            v-model="category.parent_id"
            :options="categoriesList"
            key-by="id"
            value-by="id"
            text-by="title"
            :label="t('table.column.parent_id')"
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

const {t} = useI18n()

const router = useRouter()

const props = defineProps(["category"])


const category = ref({})

import {getCurrentInstance} from 'vue'
import {useToast} from "vuestic-ui";

const app = getCurrentInstance()
const globalProperties = app.appContext.config.globalProperties


if (props.category) {
  globalProperties.$httpGet("/api/admin/blog/category/" + props.category, function (data) {
    category.value = data.category;
  })
}

const categoriesList = ref();
globalProperties.$httpGet("/api/admin/blog/category", function (data) {
  categoriesList.value = data.data;
})

function updateSearch(word){
  globalProperties.$httpGet(`/api/admin/blog/category?q=${word}`, function (data) {
    categoriesList.value = data.data;
  })
}

const {init} = useToast()

function handleSubmit() {
  globalProperties.$httpPost("/api/admin/blog/category", props.category, {category: category.value}, function (data) {
    init({
      message: data.message
    })
  });
}


</script>
