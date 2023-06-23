<template>
  <div class="row row-equal">
    <div class="flex xs12 lg6 xl6">
      <va-card v-if="dashboard_charts">
        <va-card-title>
          <h1>{{ t('dashboard.charts.register') }}</h1>
        </va-card-title>
        <va-card-content>
          <va-chart class="chart" :data="dashboard_charts.register" type="line" />
        </va-card-content>
      </va-card>
    </div>

    <div class="flex xs12 sm6 md6 lg3 xl3">
      <dashboard-contributors-chart />
    </div>
    <div class="flex xs12 sm6 md6 lg3 xl3">
      <va-card class="d-flex">
        <va-card-title>
          <h1>{{ t('dashboard.charts.loadingSpeed') }}</h1>
          <va-button icon="print" plain @click="printChart" />
        </va-card-title>
        <va-card-content v-if="doughnutChartDataGenerated">
          <va-chart ref="doughnutChart" class="chart chart--donut" :data="doughnutChartDataGenerated" type="doughnut" />
        </va-card-content>
      </va-card>
    </div>
  </div>
</template>

<script setup lang="ts">
import {getCurrentInstance, ref} from 'vue'
  import { useI18n } from 'vue-i18n'
  import { doughnutChartData } from '../../../data/charts'
  import { useChartData } from '../../../data/charts/composables/useChartData'
  import VaChart from '../../../components/va-charts/VaChart.vue'
  import DashboardContributorsChart from './DashboardContributorsList.vue'

  const { t } = useI18n()

  const doughnutChart = ref()

  const doughnutChartDataGenerated = useChartData(doughnutChartData)


  const app = getCurrentInstance()
  const globalProperties = app.appContext.config.globalProperties

  const dashboard_charts = ref();
  globalProperties.$httpGet("/api/admin/reports/charts/dashboard/all", function (data) {
    dashboard_charts.value = data.data;
  })

  function printChart() {
    const windowObjectReference = window.open('', 'Print', 'height=600,width=800') as Window

    const img = windowObjectReference.document.createElement('img')

    img.src = `${(document.querySelector('.chart--donut canvas') as HTMLCanvasElement | undefined)?.toDataURL(
      'image/png',
    )}`

    img.onload = () => {
      windowObjectReference?.document.body.appendChild(img)
    }

    windowObjectReference.print()

    windowObjectReference.onafterprint = () => {
      windowObjectReference?.close()
    }
  }
</script>

<style scoped>
  .chart {
    height: 400px;
  }
</style>
