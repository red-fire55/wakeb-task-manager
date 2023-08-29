<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>
  <div v-else>
    <div class="flex gap-[4%] mt-10">
      <div class="w-[48%] bg-white p-4 rounded-lg shadow-lg">
        <Progress class="w-[96%]" :data="statistics.project_progress" />
        <taskCards
          class="w-[96%]"
          :data="{
            opened_tasks: statistics.opened_tasks,
            completed_tasks: statistics.completed_tasks,
          }"
        />
        <milestoneCards
          class="w-[96%]"
          :data="{
            opened_milestones: statistics.opened_milestones,
            completed_milestones: statistics.completed_milestones,
          }"
        />
      </div>
      <div class="w-[48%]">
        <chart1 :data="statistics.project_progress" />
        <chart2 :data="statistics.project_progress" />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import Progress from "Component/overview/progress.vue";
import taskCards from "Component/overview/task-cards.vue";
import milestoneCards from "Component/overview/milestone-cards.vue";
import chart1 from "Component/overview/chart1.vue";
import chart2 from "Component/overview/chart2.vue";
import { axios } from "spack";
import { useProjectDetail } from "Store/project-detail";

const project = useProjectDetail();
let statistics = ref({});

axios.get(`projects/${project.data.id}/statistics`).then((res) => {
  statistics.value = res.data;
});

import { Loader } from "@/thetheme";
import { useIndexStore } from "@/spack";
import { ref } from "vue";
</script>

<style scoped></style>
