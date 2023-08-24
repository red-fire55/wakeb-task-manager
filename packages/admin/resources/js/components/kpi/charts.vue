<template>
  <div class="flex mt-8 content-between justify-between">
    <!-- kpis and categories chart -->
    <chart class="w-[49%]" :title="'Kpi and categories'"/>
    <!-- kpis and categories chart -->
    <chart class="w-[49%]" :title="'Kpi and categories'"/>
  </div>
</template>

<script setup lang="ts">
import chart from "../common/chart.vue"
import {axios } from "spack"

axios.get("charts").then(res=>{
    localStorage.setItem("charts", res.data.data)
})
</script>

<style>

</style>