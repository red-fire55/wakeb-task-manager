<template>
  <Dropdown close-outside :close="closeDropdown" :modal="true">
    <template #trigger>
      <div
        class="group mt-1 flex cursor-pointer items-center rounded-md px-2 py-1.5 hover:bg-gray-200"
      >
        <div class="flex items-center px-2" data-cooltipz-dir="top">
          <FunnelIcon class="h-6 w-6 text-gray-500" />

          <span class="block text-sm leading-none text-gray-600 ltr:ml-1.5 rtl:mr-1.5">
            Filters
          </span>
        </div>
      </div>
    </template>

    <template #content>
      <div
        class="absolute z-30 mt-2 ltr:left-0 ltr:origin-top-left rtl:right-0 rtl:origin-top-right bg-white min-h-[15px] w-[200px] pt-3 pb-3 rounded-lg shadow-lg"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="user-menu"
      >
        <ul
          class="py-2 text-sm text-gray-700 dark:text-gray-200"
          aria-labelledby="dropdownUserAvatarButton"
        >
          <li class="px-4">
            <div class="px-1 block">filtered by categories</div>
            <a
              href="#"
              v-for="(item, i) in filters.categories"
              :key="i"
              @click="remove_category(item)"
              class="block px-1 py-2 bg-indigo-500 text-white text-xs mt-2 rounded-lg text-center"
            >
              {{ item.name }}</a
            >
          </li>
          <li
            v-if="filters.dates.length > 1"
            @click="remove_date"
            class="px-4 mt-2 cursor-pointer"
          >
            <div class="px-1 block">filtered by date</div>
            <a
              href="#"
              class="block px-1 py-2 bg-green-500 text-white text-xs mt-2 rounded-lg text-center mt-2"
            >
              <div class="w-full">FROM : {{ filters.dates[0] }}</div>
            </a>
            <a
              href="#"
              class="block px-1 py-2 bg-green-500 text-white text-xs mt-2 rounded-lg text-center mt-2"
            >
              <div class="w-full">TO : {{ filters.dates[1] }}</div>
            </a>
          </li>
        </ul>
      </div>
    </template>
  </Dropdown>
</template>

<script setup lang="ts">
import { FunnelIcon } from "@heroicons/vue/24/solid";
import { Dropdown } from "thetheme";
import { defineEmits } from "vue";

defineProps<{
  filters?: Array<object>;
}>();

const emit = defineEmits(["removeCategory", "removeDate"]);

function remove_category(item) {
  emit("removeCategory", item);
}
function remove_date() {
  emit("removeDate");
}
</script>

<style></style>
