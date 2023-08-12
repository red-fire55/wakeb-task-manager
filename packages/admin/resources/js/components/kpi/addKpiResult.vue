<template>
    <FormModelAdd  :name="name" :uri="`/kpis/${props.id}/results`">
        
<TextArea name="description" label="Result"  class="col-span-12"/>
         <div class="col-span-12">

             <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Previous Result</h2>
             <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                 <li class="flex items-center" v-for="(item, i) in previous_results" :key="i">
                     <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                     </svg>
                     {{ item.description }}
                 </li>
                 
                
             </ul>


         </div>

    </FormModelAdd>
</template>

<script setup lang="ts">
import { FormModelAdd, useTextArea, useFieldText } from 'thetheme'
import { useFormStore, useIndexStore, useModalsStore, axios } from 'spack'
import { ref } from 'vue'


const props =defineProps<{
    id?: number
}>()

const name = 'Result'
const form = useFormStore(name)()
const index = useIndexStore(name)()
const TextArea = useTextArea<any>()
 const FieldText = useFieldText<any>()
 let previous_results = ref<any[]>([]) 
setTimeout(()=>{
    form.data['kpi_id']= props.id
}, 500)


axios.get(`/kpis/${props.id}/results`).then(res=>{
 previous_results.value = res.data.data
})

form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
})
</script>
