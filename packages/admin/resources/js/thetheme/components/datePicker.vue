<template>
  <section class="py-0">
    <h2 class="px-2 text-sm font-medium text-gray-600">{{ __(props.name) }}</h2>

    

    <Dropdown
      close-outside
      :close="closeDropdown"
      :modal="true"
    >
      <template #trigger>
        <div
          class="group mt-1 flex cursor-pointer items-center rounded-md px-2 py-1.5 hover:bg-gray-200"
        >
        <div
      class="flex items-center px-2"
      data-cooltipz-dir="top"
    >
      <CalendarIcon class="h-6 w-6 text-gray-500" />

      <span
        class="block text-sm leading-none text-gray-600 ltr:ml-1.5 rtl:mr-1.5"
      >
        {{ form.data[props.value] ? form.data[props.value] : __('No selected date') }}
      </span>
      <!-- <span
          v-if="date"
            class="ml-auto flex h-4 w-4 items-center justify-center rounded-md hover:bg-gray-300"
          >
            <XMarkIcon class="h-3.5 w-3.5 text-gray-600" />
            
          </span> -->
    </div>
          
          
        </div>
      </template>

      <template #content>
        <div
          class="absolute z-30 mt-2 ltr:left-0 ltr:origin-top-left rtl:right-0 rtl:origin-top-right"
          role="menu"
          aria-orientation="vertical"
          aria-labelledby="user-menu"
        >
          <Calendar
            @selected="onDateSelected"
          />
        </div>
      </template>
    </Dropdown>
  </section>
</template>

<script setup lang="ts">
  import { ref } from 'vue'
  import { Calendar, Dropdown } from 'thetheme'
  import { CalendarIcon, XMarkIcon } from '@heroicons/vue/24/outline'
  import { axios, useFormStore } from 'spack'

  const closeDropdown = ref(false)
 const props = defineProps<{
    name: string,
    value: string,
    formName: string
  }>()
const form = useFormStore(props.formName)()

  let date = form.data[props.value]

  const onDateSelected = function (payload: any) {
    closeDropdown.value = true
    form.data[props.value] = payload.date 
    date.value = payload.date
  }
</script>
