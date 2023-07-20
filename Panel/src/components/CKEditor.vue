<template>
  <div  style="color: black">
    <ckeditor :editor="editor" v-model="localValue" :config="editorConfig" @ready="onReady"
              @input="onChange"></ckeditor>
  </div>
</template>
<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue"

export default {
  props: {
    value: String,
    lang: String
  },
  name: 'ck-editor',
  components: {
    ckeditor: CKEditor.component
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        language: this.lang,
        defaultLanguage: this.lang,
        height: '25em',
      },
      localValue: this.value
    };
  },
  methods: {
    onReady() {
      setTimeout(() => {
        this.localValue = this.value
      }, 600)
      console.log(this.lang)
    },
    onChange(data) {
      this.$emit('change', {data: data});
    },
  }
}
</script>
<style>
.ck.ck-content {
  min-height: 300px;
}
</style>
