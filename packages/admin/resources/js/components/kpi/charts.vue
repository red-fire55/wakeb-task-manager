<template>
  <div class="flex mt-8 content-between justify-between flex-wrap">
    <!-- kpis and categories chart -->
    <chart
      class="w-[49%] mt-3"
      :title="'Kpi and categories'"
      :data="home.charts.chart_kpis_by_category"
    />
    <!-- kpis and categories chart -->
    <chart
      class="w-[49%] mt-3"
      :title="'Kpi and Status'"
      :data="home.charts.chart_kpis_by_status"
    />
    <!-- kpis and categories chart -->
    <chart
      class="w-[49%] mt-3"
      :title="'Kpi and Weight'"
      :data="home.charts.chart_kpis_with_weight"
    />
  </div>
</template>

<script setup lang="ts">
import chart from "../common/chart.vue";
import { axios } from "spack";
import { useHomeStore } from "Store/home";

const home = useHomeStore();
</script>

<style></style>
