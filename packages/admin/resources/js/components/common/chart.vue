<template>
  <section class="">
    <div class="">
      <Card class="py-4 ltr:pl-4 ltr:pr-3 rtl:pr-4 rtl:pl-3">
        <h3 class="mb-4 font-medium">
          {{ props.title }}
        </h3>

        <div style="">
          <LineChart
            :id="props.title"
            :data="props?.data"
            tooltip-label="Tasks"
            background-color="rgba(79, 70, 229, 0.2)"
            border-color="#4F46E5"
          />
        </div>
      </Card>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useHomeStore } from "Store/home";
import { LineChart } from "thetheme";
import { Card } from "thetheme";

const props = defineProps<{
  title?: string;
  data?: object;
}>();
const home = useHomeStore();
</script>
