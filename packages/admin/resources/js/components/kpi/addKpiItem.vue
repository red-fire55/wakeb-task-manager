<template>
    <FormModelAdd :id="id" :name="name" uri="users">
        <div class="col-span-12">
            <label for="message" class="block  text-sm font-medium text-gray-900  ">Result</label>
            <textarea id="message" rows="4"  class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write New Result here..."></textarea>
        </div>

         <div class="col-span-12">


             <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Previous Result</h2>
             <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                 <li class="flex items-center">
                     <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                     </svg>
                     At least 10 Result
                 </li>
                 <li class="flex items-center">
                     <svg class="w-3.5 h-3.5 mr-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                     </svg>
                     At least one lowercase character
                 </li>
                 <li class="flex items-center">
                     <svg class="w-3.5 h-3.5 mr-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                     </svg>
                     At least one special character, e.g., ! @ # ?
                 </li>
             </ul>


         </div>

    </FormModelAdd>
</template>

<script setup lang="ts">
import { FormModelAdd } from 'thetheme'
import { useFormStore, useIndexStore, useModalsStore } from 'spack'

defineProps<{
    id?: number
}>()

const name = 'balance score'
const form = useFormStore(name)()
const index = useIndexStore(name)()

form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
})
</script>
