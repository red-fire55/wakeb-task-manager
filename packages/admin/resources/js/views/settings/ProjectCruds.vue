<template>
  <SettingsLayout>
      <div class="w-1/4 ml-auto">
          <label  class="block mb-2 text-sm font-medium text-gray-900 "> {{ __('Select crud') }}</label>
          <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " v-model="selected"  >
              <option  v-for="i in selectedItems"  :key="i" >{{i}} </option>
          </select>
      </div>
      <category v-if="selected == 'Category'"/>
  </SettingsLayout>
</template>

<script setup>
import Category from "Component/cruds/category.vue";
import SettingsLayout from "View/settings/SettingsLayout.vue";
const selectedItems = ["","Category","cruds"];
const selected  = "";

</script>
