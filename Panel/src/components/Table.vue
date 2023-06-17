<template>
  <div>
    <form v-if="!props.disable_search" role="search">
      <div class="flex">
        <router-link
          v-for="(button, key) in props.features_buttons"
          :key="key"
          :to="`${button.link}`"
        >
          <el-button type="success">
            {{ button.title }}
          </el-button>
        </router-link>
        <va-input  @change="handleSearch" v-model="search.q" :placeholder="t('table.search')" clearable />
      </div>
    </form>
    <el-table
      :data="ref_data.data"
      style="width: 100%"
      :style="`text-align: ${locale === 'ir' ? 'right' : 'left'}`"
      :empty-text="empty_text"
      @sort-change="sort_change"
    >
      <el-table-column
        v-for="column in props.columns"
        :label="column.title"
        :class-name="locale === 'ir' ? 'is-right' : ''"
        :sortable="!column.child"
      >
        <template #default="scope">
          <span v-if="!get_link(column, scope)" v-html="showdata(column, scope.row)"></span>
          <router-link
            v-if="column.target !== 'blank' && get_link(column, scope)"
            :to="get_link(column, scope)"
            v-html="showdata(column, scope.row)"
          ></router-link>
          <a
            v-if="column.target === 'blank' && get_link(column, scope)"
            target="_blank"
            :href="get_link(column, scope)"
            v-html="showdata(column, scope.row)"
          ></a>
        </template>
      </el-table-column>
      <el-table-column
        v-if="!props.disable_edit || (props.buttons && props.buttons.length) || props.clickable_buttons"
        :label="t('table.features')"
      >
        <template #default="scope">
          <router-link v-if="!props.disable_edit" :to="`${props.api}/edit/${scope.row.id}`" :title="t('table.edit')">
            <el-button size="small">
              <i class="fa fa-edit"></i>
            </el-button>
          </router-link>
          <router-link
            v-for="button in props.buttons"
            v-show="
              (!button.filter || scope.row[button.filter]) && (!button.filter_not || !scope.row[button.filter_not])
            "
            :to="button_link(button, scope.row)"
          >
            <el-button size="small" :type="button.type || 'info'">{{ button.title }} </el-button>
          </router-link>
          <el-button
            v-for="button in props.clickable_buttons"
            size="small"
            :type="button.type || 'info'"
            @click="emit('button_function', button, scope.row)"
            >{{ button.title }}
          </el-button>
        </template>
      </el-table-column>
    </el-table>

    <div v-if="ref_data.last_page > 1" class="text-center">
      <vue-awesome-paginate
        :total-items="ref_data.total"
        :items-per-page="ref_data.per_page"
        :max-pages-shown="5"
        :model-value="query.page"
        :on-click="toPage"
        locale="ar"
      />
    </div>
  </div>
</template>

<script lang="ts" setup>
  import { ref, watch } from 'vue'
  import {useI18n} from "vue-i18n";

  const emit = defineEmits(['button_function'])
  const query = ref({ page: 1, sort_by: "", order: ""})
  const search = ref({ q: '' })
  let ref_data = ref({})
  const empty_text = ref({})

  const { t, locale } = useI18n()

  const sort_change = (data) => {
    query.value.sort_by = props.columns[data.column.no].data || ''
    query.value.order = data.order || ''
    renderTable()
  }

  const handleSearch = () => {
    renderTable()
  }
  const get_link = function (column, scope) {
    if (column.full_link)
      return button_link(column, column.child && scope.row[column.data] ? scope.row[column.data] : scope.row)
    return false
  }

  const showdata = function (column, scope_row) {
    if (column.object) {
      return column.object.value[scope_row[column.child]]
    } else if (column.is_boolean) {
      return `<input type='checkbox' ${scope_row[column.data] ? 'checked' : ''} disabled />`
    } else if (column.data == 'created_at') {
      return scope_row[column.data]
    } else {
      let data = column.child && scope_row[column.data] ? scope_row[column.data][column.child] : scope_row[column.data]
      if (column.data.indexOf('amount') !== -1) return Intl.NumberFormat('en-US').format(data)
      return data
    }
  }

  function toPage(page) {
    query.value.page = page
    renderTable()
  }

  function button_link(button, scope_row) {
    if (button.full_link) {
      let link = button.full_link
      Object.keys(scope_row).forEach(function (key) {
        link = link.replace(`{${key}}`, scope_row[key])
        if (scope_row[key]) {
          Object.keys(scope_row[key]).forEach(function (key2) {
            link = link.replace(`{${key}.${key2}}`, scope_row[key][key2])
          })
        }
      })
      return link
    } else {
      return `${props.api}/${button.link}/${scope_row.id}`
    }
  }

  const props = defineProps([
    'api',
    'columns',
    'buttons',
    'features_buttons',
    'clickable_buttons',
    'disable_edit',
    'query',
    'disable_search',
  ])

  watch(
    () => props.query,
    () => {
      renderTable()
    },
  )

  function renderTable() {
    empty_text.value = 'Processing ...'
    ref_data.value = []
    fetch(
      '/api' +
        props.api +
        '?' +
        new URLSearchParams(query.value).toString() +
        '&q=' +
        search.value.q +
        '&' +
        props.query,
      {
        method: 'GET',
        headers: {
          Accept: 'application/json',
        },
      },
    )
      .then(function (response) {
        if (response.status != 200) {
          empty_text.value = 'Error .'
          throw response.status
        } else {
          empty_text.value = `Processing in front ...`
          return response.body
        }
      })
      .then(function (data) {
        const reader = data.getReader()
        let loaded = 0
        let chunks = []

        function read() {
          return reader.read().then(({ done, value }) => {
            if (done) {
              return chunks
            }
            chunks = chunks.concat([...value])
            loaded += value.length
            const total = 140 * 1000
            const percentage = Math.round((loaded / total) * 100)

            empty_text.value = `Downloading ... (${percentage})`

            return read()
          })
        }

        return read()
      })
      .then(function (chunks) {
        let data = JSON.parse(new TextDecoder().decode(Uint8Array.from(chunks)))

        if (!data.total) empty_text.value = `Data not found.`
        ref_data.value = data
      })
      .catch(function (error) {
        console.error(error)
      })
  }

  renderTable()
</script>
<style scoped>
  .search-input {
    padding-left: 15px !important;
  }

  .page-item {
    float: right;
  }

  .input-group-addon.el-button--success {
    background-color: green !important;
  }
</style>
<style>
  .pagination-container {
    display: flex;
    column-gap: 10px;
    margin-top: 20px;
  }

  .paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: rgb(242, 242, 242);
    border: 1px solid rgb(217, 217, 217);
    color: black;
  }

  .paginate-buttons:hover {
    background-color: #d8d8d8;
  }

  .active-page {
    background-color: #3498db;
    border: 1px solid #3498db;
    color: white;
  }

  .active-page:hover {
    background-color: #2988c8;
  }
  .flex{
    display: flex;
  }
</style>
