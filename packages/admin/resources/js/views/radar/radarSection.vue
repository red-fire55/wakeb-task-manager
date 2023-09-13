<template>
  <div class="w-[100vw]" >
    <table  class="w-[100vw]">
      <tr>
        <th
          :class="`w-full pr-3 pl-3`"
          :style="`background-color: ${bgColor}; height: 100px `"
        >
          {{ title }}
        </th>
      </tr>
    </table>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  title?: string;
  bgColor?: number;
}>();
</script>

<style></style>
