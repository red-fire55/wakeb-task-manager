<template>
  <section class="mt-10">
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-2">
      <div
        class="relative overflow-hidden rounded-lg bg-white py-5 px-4 shadow sm:py-6 sm:px-6 shadow-lg"
      >
        <dt class="w-full">
          <div class="flex justify-between w-full items-center mb-2">
            <div class="rounded-md bg-gray-400 p-1">
              <CheckCircleIcon class="h-6 w-6 text-white" />
            </div>
            <p class="text-sm font-medium text-gray-500">
              {{ __("Open Tasks") }}
            </p>
          </div>
          <div class="border-b-1">
            <div class="flex justify-between mb-1">
              <span class="text-sm font-medium text-gray-800"
                >{{ props.data.opened_tasks }}%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-300">
              <div
                class="bg-green-600 h-1.5 rounded-full"
                :style="`width: ${Number(props.data.opened_tasks)}%`"
              ></div>
            </div>
          </div>
        </dt>
      </div>
      <div
        class="relative overflow-hidden rounded-lg bg-white py-5 px-4 shadow sm:py-6 sm:px-6 shadow-lg"
      >
        <dt>
          <div class="flex justify-between items-center mb-2">
            <div class="rounded-md bg-gray-400 p-1">
              <CalendarDaysIcon class="h-6 w-6 text-white" />
            </div>
            <p class="text-sm font-medium text-gray-500">
              {{ __("Completed Tasks") }}
            </p>
          </div>
          <div class="border-b-1">
            <div class="flex justify-between mb-1">
              <span class="text-sm font-medium text-gray-800"
                >{{ props.data.completed_tasks }}%</span
              >
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-300">
              <div
                class="bg-green-600 h-1.5 rounded-full"
                :style="`width: ${Number(props.data.completed_tasks)}%`"
              ></div>
            </div>
          </div>
        </dt>
      </div>
    </dl>
  </section>
</template>

<script setup lang="ts">
import { CheckCircleIcon, CalendarDaysIcon } from "@heroicons/vue/24/outline";
import Progress from "Component/overview/progress.vue";
const props = defineProps<{
  data?: object;
}>();
</script>

<style scoped></style>
