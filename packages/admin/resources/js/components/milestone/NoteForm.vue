<template>
  <FormModal :id="id" :name="name" uri="milestone">
    <div v-if="processing" class="mt-8 flex justify-center absolute">
        <Loader size="40" color="#5850ec" />
    </div>
        <div class="col-span-6">
            <TextArea name="note" label="Notes"  class="col-span-12 mt-2 mt-1"/>
            
        </div>
         <div class="col-span-6 bg-gray-100 p-2" v-if="form.data.notes.length > 0">
             <h2 class="mb-2 text-lg font-semibold text-gray-900 p-2">Previous Notes</h2>
             <ul class="max-w-md space-y-1 text-gray-500 list-inside p-2">
                 <li class="flex items-center cursor-pointer bg-white p-2" v-for="(item, i) in form.data.notes" :key="i" @click="show(item)">
                     <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                     </svg>
                     {{ item.description }}
                 </li>


             </ul>


         </div>
  </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useTextArea } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'
  import {useProjectDetail} from "Store/project-detail";

  defineProps<{
    id?: number
  }>()

  const name = 'milestone notes'
  const form = useFormStore(name)()
  const index = useIndexStore(name)()
  const TextArea = useTextArea<any>()
  const project = useProjectDetail()

  setTimeout(()=>{
    form.data['project_id'] = project.data.id
    delete form.data['projects']
    delete form.data['tasks']
  }, 1000)
  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
