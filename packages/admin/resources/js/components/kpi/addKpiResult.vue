<template>
    <FormModelAdd  :name="name" :uri="`/kpis/${props.id}/results`">
    <div v-if="processing" class="mt-8 flex justify-center absolute">
        <Loader size="40" color="#5850ec" />
    </div>
        <div class="col-span-6">
            <FieldText name="title" label="Title"  class="col-span-12" />
            <TextArea name="description" label="Description"  class="col-span-12 mt-2 mt-1"/>
            <FieldText name="created_at" label="Date"  class="col-span-12 mt-1" disabled/>
            <FieldText name="creator" label="Creator"  class="col-span-12 mt-1" disabled v-if="result_id > -1"/>
        </div>
         <div class="col-span-6 bg-gray-100 p-2" v-if="previous_results.length > 0">
             <h2 class="mb-2 text-lg font-semibold text-gray-900 p-2">Previous Result</h2>
             <ul class="max-w-md space-y-1 text-gray-500 list-inside p-2">
                 <li class="flex items-center cursor-pointer bg-white p-2" v-for="(item, i) in previous_results" :key="i" @click="show(item)">
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
import {FormModelAdd, useTextArea, useFieldText, useFieldSelect, DatePicker} from 'thetheme'
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
const FieldSelect = useFieldSelect<any>()
 let previous_results = ref<any[]>([])
 let processing = ref(false)
 let result_id = ref(-1)
setTimeout(()=>{
    form.data['kpi_id']= props.id
}, 1000)


axios.get(`/kpis/${props.id}/results`).then(res=>{
 previous_results.value = res.data.data
})

const show = async (item)=>{
    processing.value = true
    let result = (await axios.get(`/kpis/${props.id}/results/${item.id}`)).data.data

    form.data['title'] = item.title
    form.data['description'] = item.description
    form.data['created_at'] = new Date(item.created_at).toISOString().substr(0,10)
    form.data['creator'] = item.creator.name
    processing.value = false
    result_id = item.id
}



form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
})
</script>
