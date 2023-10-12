<template>
  <div class="w-[100vw] h-[794px] text-left">
    <table class="w-[100vw]">
      <tr>
        <th :class="`w-full`" :style="`height: 25px;`">
          <img
            style="background-image: linear-gradient(to bottom right, #53bbe7, whitesmoke)"
            class="w-full absolute z-0 h-[185px]"
          />
          <!-- <img :src="img" class="absolute float-right h-[170px] mt-2 z-30" alt=""> -->
          <h3 class="text-[24px] font-bold z-10 relative ml-5 mt-8 text-white">
            {{ props.title }}
          </h3>
        </th>
      </tr>
      <tr>
        <td class="flex flex-row flex-wrap w-[800px] gap-1 mt-28">
          <figure
            class="flex flex-col items-start justify-start p-8 pt-0 text-center rounded-b-lg md:rounded-br-lg w-[260px] h-[710px]"
            style="background-image: linear-gradient(to bottom right, #11044c, grey)"
          >
            <figcaption
              class="flex items-center justify-center space-x-3 pt-4 pb-4"
              v-for="(item, i) in props.rings"
              :key="i"
            >
              <div class="space-y-0.5 font-medium text-white text-left">
                <h5 :style="`color: ${item.color}`">{{ item.name }}</h5>
                <div
                  class="text-sm text-gray-500 dark:text-gray-400"
                  v-for="(unit, i) in props.units"
                  :key="i"
                >
                  <span v-if="unit.level == item.name">
                    {{ unit.label }}
                  </span>
                </div>
              </div>
            </figcaption>
          </figure>
          <figure
            class="flex flex-col items-start justify-start p-8 bg-white border-gray-200 rounded-b-lg md:rounded-br-lg dark:bg-gray-800 dark:border-gray-700 w-[260px] text-left"
            v-for="(item, i) in props.units"
            :key="i"
          >
            <figcaption class="flex items-center justify-center space-x-3">
              <!-- <img
                class="rounded-full w-9 h-9"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                alt="profile picture"
              /> -->
              <div class="space-y-0.5 font-medium dark:text-white text-left">
                <div>{{ item.label }} ({{ item?.level }})</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                  {{ item.category }}
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                  {{ item.description }}
                </div>
              </div>
            </figcaption>
          </figure>
        </td>
      </tr>
    </table>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  title?: string;
  bgColor?: number;
  units?: any;
  rings?: any;
}>();
const img = "data:image/png;base64,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"
  
</script>

<style></style>
