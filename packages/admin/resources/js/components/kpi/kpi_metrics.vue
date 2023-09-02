<template>
  <section class="mb-10">
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <div
        :class="
          item.active
            ? 'relative overflow-hidden rounded-lg bg-indigo-500 py-5 px-4 shadow sm:py-6 sm:px-6 cursor-pointer'
            : 'relative overflow-hidden rounded-lg bg-white py-5 px-4 shadow sm:py-6 sm:px-6 cursor-pointer'
        "
        v-for="(item, i) in categories"
        :key="i"
        @click="filter_kpi(item)"
      >
        <dt>
          <div
            :class="
              item.active
                ? 'absolute rounded-md bg-white p-3'
                : 'absolute rounded-md bg-indigo-500 p-3'
            "
          >
            <inbox-icon
              :class="item.active ? 'h-6 w-6 text-indigo-500' : 'h-6 w-6 text-white'"
            />
          </div>
          <p
            :class="
              item.active
                ? 'truncate text-sm font-medium text-white ltr:ml-16 rtl:mr-16'
                : 'truncate text-sm font-medium text-gray-500 ltr:ml-16 rtl:mr-16'
            "
          >
            {{ item.name }}
          </p>
        </dt>
        <dd class="flex items-baseline ltr:ml-16 rtl:mr-16">
          <p
            :class="
              item.active
                ? 'text-2xl font-semibold text-white'
                : 'text-2xl font-semibold text-gray-900'
            "
          >
            {{ item.category_count }} Kpi
          </p>
        </dd>
      </div>
    </dl>
  </section>
</template>

<script setup lang="ts">
import { useHomeStore } from "Store/home";
import { CalendarIcon, CheckCircleIcon, InboxIcon } from "@heroicons/vue/24/outline";
import { ref, defineEmits, watch } from "vue";
import { axios } from "spack";
let categories = ref([]),
  filter_categories = [];
const emit = defineEmits(["filterKpis"]);

const filter_kpi = (item) => {
  item.active = true;
  let index = filter_categories.indexOf(item);
  if (index == -1) {
    filter_categories.push(item);
    emit("filterKpis", filter_categories);
  }
};

const props = defineProps<{
  filters?: object;
}>();
watch(
  () => props.filters,
  (val) => {
    categories.value.forEach((category) => {
      let check = val.categories.indexOf(category);
      check == -1 ? (category.active = false) : "";
    });
  },
  { deep: true }
);
axios.get("kpiCategories").then((res) => {
  categories.value = res.data.data;
});

const home = useHomeStore();
</script>
