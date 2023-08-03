<template>
    <FormModal :id="id" :name="name" uri="users">
        <FieldText name="Mesure" label="Mesure" class="col-span-6" />
        <FieldText name="Owner Name" label="Owner Name" class="col-span-6" />
        <FieldText name="Previous Result" label="Previous Result" class="col-span-6" />
        <div class="col-span-6">
            <label for="countries" class="block text-sm font-medium text-gray-900 ">Categories</label>
            <select id="countries" class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 col-span-6">
                <option selected>Choose a Categories</option>
                <option value="US">Categories 1</option>
                <option value="CA">Categories 2</option>
                <option value="FR">Categories 3</option>
                <option value="DE">Categories 4</option>
            </select>

        </div>
<!--        <FieldSelect name="Categories" label="Categories" class="col-span-6" />-->
        <div class="col-span-6">
            <label for="message" class="block  text-sm font-medium text-gray-900 ">  Previous Result</label>
            <textarea id="message" rows="4"  disabled class="lock p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write your   Previous Result here..."></textarea>
        </div>
         <div class="col-span-6">
             <label for="message" class="block  text-sm font-medium text-gray-900  ">Notes</label>
             <textarea id="message" rows="4" disabled class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write your notes here..."></textarea>
         </div>

    </FormModal>
</template>

<script setup lang="ts">
import { FormModal, useFieldText } from 'thetheme'
import { useFormStore, useIndexStore, useModalsStore } from 'spack'

defineProps<{
    id?: number
}>()

const name = 'user'
const form = useFormStore(name)()
const index = useIndexStore(name)()
const FieldText = useFieldText<any>()
// const FieldSelect = useFieldSelect<any>()

form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
})
</script>
