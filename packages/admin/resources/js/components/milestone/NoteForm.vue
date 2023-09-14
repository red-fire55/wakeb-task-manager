<template>
  <FormModal :id="props.id" :name="name" uri="milestone">
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
      <ol class="relative border-l border-gray-200 mt-10">
        <li class="mb-10 ml-6" v-for="(note, i) in notes" :key="i">
          <span
            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white"
          >
            <img
              class="rounded-full shadow-lg"
              :src="note.causer.avatar"
              alt="Bonnie image"
            />
          </span>
          <div
            class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex"
          >
            <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{
              note.updated_at.toString().substr(0, 10)
            }}</time>
            <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
              قام {{ note?.causer?.name }}
              بإدخال الملحوظة
              <a
                href="#"
                class="font-semibold text-blue-600 dark:text-blue-500 hover:underline"
                >{{ note?.properties?.new.note }}</a
              >
            </div>
          </div>
        </li>
      </ol>
    </div>
  </FormModal>
</template>

<script setup lang="ts">
import { FormModal, useTextArea } from "thetheme";
import { useFormStore, useIndexStore, useModalsStore, axios } from "spack";
import { useProjectDetail } from "Store/project-detail";
import { ref } from "vue";

const props = defineProps<{
  id?: number;
}>();

const name = "milestone note";
const form = useFormStore(name)();
const index = useIndexStore(name)();
const TextArea = useTextArea<any>();
const project = useProjectDetail();
let show = ref("create");
let notes = ref([]);
let milestone_id = props.id
axios.get(`logs?milestone=${milestone_id}`).then((res) => {
  localStorage.setItem("note", JSON.stringify(res.data.data))
  notes.value = res.data.data;
});
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
