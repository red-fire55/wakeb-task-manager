<template>
  <div class="border-b-1 mt-10">
    <div class="flex justify-between mb-1">
      <span class="text-base font-medium text-gray-800">Progect Progress</span>
      <span class="text-sm font-medium text-gray-800">{{ props.data }}%</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-300">
      <div
        class="bg-green-600 h-1.5 rounded-full"
        :style="`width:  ${Number(props.data)}%`"
      ></div>
    </div>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  data?: any;
}>();
</script>

<style lang="scss" scoped></style>
