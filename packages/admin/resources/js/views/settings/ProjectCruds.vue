<template>
  <SettingsLayout>
      <div class="w-1/4 ml-auto">
          <label  class="block mb-2 text-sm font-medium text-gray-900 "> {{ __('Select crud') }}</label>
          <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
           v-model="selectedOption"  >
              <option  v-for="i in selectedItems"  :key="i" >{{i}} </option>
          </select>
      </div>
      <category class="mt-10" v-if="selectedOption === 'category'" />
      <deoartments class="mt-10" v-if="selectedOption === 'department'"/>
      <types class="mt-10" v-if="selectedOption === 'types'"/>
  </SettingsLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import Category from "Component/cruds/category.vue";
import SettingsLayout from "View/settings/SettingsLayout.vue";
import Deoartments from "Component/cruds/Deoartments.vue";
import Types from "Component/cruds/Types.vue";
const selectedItems = ["category","department","types"];
const selectedOption = ref('category');
watch(selectedOption, (newValue) => {
    console.log(`Selected option changed to: ${newValue}`);
});
</script>
