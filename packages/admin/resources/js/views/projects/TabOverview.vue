<template>
  <div>
      <div class="flex   gap-[4%] mt-10 shadow-lg">
          <div class="w-[48%] bg-white p-4 rounded-lg">
              <Progress/>
          </div>
          <div class="w-[48%] ">
              <card_overview/>
          </div>
      </div>
       <div >
           <overview_table/>
       </div>
      <div class="flex justify-between gap-[4%]">
          <div class="w-[48%] ">
              <statc_table/>
              <static_table_2/>

          </div>
          <div class="w-[48%] ">
              <chart_overview/>

          </div>

      </div>

  </div>
</template>

<script setup lang="ts">

import Progress from "Component/overview/progress.vue";
import Card_overview from "Component/overview/card_overview.vue";
import Overview_table from "Component/overview/overview_table.vue";
import Statc_table from "Component/overview/statc_table.vue";
import Static_table_2 from "Component/overview/static_table_2.vue";
import Chart_overview from "Component/overview/chart_overview.vue";

</script>

<style scoped>

</style>
