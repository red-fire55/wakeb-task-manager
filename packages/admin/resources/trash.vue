<template>
  <!-- pie basic level -->
 <div class="grid justify-center">
     <div class="pie w-[550px] h-[550px] bg-white rounded-full flex flex-row flex-wrap border border-grey overflow-hidden">
      <div class="h-[50%] w-[50%] bg-white rounded-tl-full flex justify-end content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-tl-full self-end">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[green]  flex justify-start content-start">
        <div class="h-[30%] w-[30%] border border-black rounded-tr-full self-end">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[yellow] flex justify-end content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-bl-full self-start">
        </div>
      </div>
      <div class="h-[50%] w-[50%]  bg-[red] flex justify-start content-end">
        <div class="h-[30%] w-[30%] border border-black rounded-br-full self-start">
        </div>
      </div>
  </div>
 </div>
</template>

<script>
export default {

}
</script>

<style>
 .pie{
 }
</style>


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