<template>
  <section class="py-3.5">
    <div class="flex items-center px-2">
      <h2 class="text-sm font-medium text-gray-600">asign milestone</h2>

      <MilestoneAssign v-if="can('task:update')" class="ml-auto"/>
    </div>

    <div  class="flex flex-wrap px-2 pt-2">
      {{ task.data.milestone_id? task.data.milestone_id: "no milestone" }}
    </div>
  </section>
</template>

<script setup lang="ts">
  import { useTaskStore } from 'Store/task'
  import MilestoneAssign from './MilestoneAssign.vue'

  const task = useTaskStore()
</script>
