<template>
  <section class="mb-10">
    <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <div
        class="relative overflow-hidden rounded-lg bg-white py-5 px-4 shadow sm:py-6 sm:px-6 cursor-pointer"
        v-for="(item, i) in categories"
        :key="i"
        @click="filter_kpi(item.id)"
      >
        <dt>
          <div class="absolute rounded-md bg-indigo-500 p-3">
            <inbox-icon class="h-6 w-6 text-white" />
          </div>
          <p
            class="truncate text-sm font-medium text-gray-500 ltr:ml-16 rtl:mr-16"
          >
            {{ item.name }}
          </p>
        </dt>
        <dd class="flex items-baseline ltr:ml-16 rtl:mr-16">
          <p class="text-2xl font-semibold text-gray-900">
            {{ item.category_count }} Kpi
          </p>
        </dd>
      </div>

      
    </dl>
  </section>
</template>

<script setup lang="ts">
  import { useHomeStore } from 'Store/home'
  import {
    CalendarIcon,
    CheckCircleIcon,
    InboxIcon,
  } from '@heroicons/vue/24/outline'
  import {ref, defineEmits } from "vue"
  import {axios} from "spack"
  let categories = ref([])
  const emit = defineEmits(['filterKpis'])

  const filter_kpi = (item)=>{
    emit("filterKpis", item)
  }

axios.get('kpiCategories').then(res=>{
  categories.value = res.data.data 
})
  
  const home = useHomeStore()
</script>
