<template>
  <FormModal :id="id" :name="name" uri="milestone">
    <ul
      class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400 col-span-12 mt-2 mt-1"
    >
      <li class="w-full" @click="show = 'create'">
        <a
          href="#"
          :class="
            show == 'create'
              ? `inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg  active focus:outline-none 
          focus:bg-gray-700 focus:text-white`
              : `inline-block w-full p-4  rounded-l-lg  active`
          "
          aria-current="page"
          >Create Notes</a
        >
      </li>
      <li class="w-full" @click="show = 'show'">
        <a
          href="#"
          :class="
            show != 'create'
              ? `inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 
          focus:outline-none focus:bg-gray-700 focus:text-white dark:bg-gray-800 dark:hover:bg-gray-700 rounded-r-lg`
              : `inline-block w-full p-4  text-gray-700 bg-gray-50 
          focus:outline-none focus:bg-gray-700 focus:text-white dark:bg-gray-800 dark:hover:bg-gray-700 rounded-r-lg`
          "
          >Show Previous Notes</a
        >
      </li>
    </ul>
    <TextArea
      name="note"
      label="Notes"
      class="col-span-12 mt-2 mt-1"
      v-if="show == 'create'"
    />
    <div class="col-span-12 mt-2 mt-1" v-else>
      <div class="w-100 p-3" v-for="(item, i) in form.data.notes" :key="i">
        
      </div>
    </div>
  </FormModal>
</template>

<script setup lang="ts">
import { FormModal, useFieldSelect, useFieldText, DatePicker } from "thetheme";
import { useFormStore, useIndexStore, useModalsStore } from "spack";
import { useProjectDetail } from "Store/project-detail";
import { ref } from "vue";

defineProps<{
  id?: number;
}>();

const name = "milestone note";
const form = useFormStore(name)();
const index = useIndexStore(name)();
const FieldText = useFieldText<any>();
const FieldSelect = useFieldSelect<any>();
const project = useProjectDetail();
let show = ref("create");
setTimeout(() => {
  form.data["project_id"] = project.data.id;
}, 500);
form.onSuccess(() => {
  index.fetch();
  useModalsStore().pop();
});
</script>
<style scoped>
.modal-content section {
  width: 80vw !important;
}
</style>
