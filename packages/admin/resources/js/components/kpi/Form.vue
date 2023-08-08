<template>
   <FormModal :id="id" :name="name" uri="kpis">
        <FieldText name="measure" label="Mesure" type="number" class="col-span-12" />
        <FieldSelect name="owner_id" label="Owner Name"  class="col-span-12"/>
        <FieldText name="target" label="Target"  class="col-span-12"/>

        <FieldText name="status" label="Status"  class="col-span-12"/>
        <FieldText name="sub_weight" label="Weight"  class="col-span-12"/>
      
        <FieldSelect name="frequency" label="Frequency" class="col-span-12" />
        
        <FieldSelect name="kpi_category_id" label="Category" class="col-span-12" />
        <div class="col-span-12">
            <label for="message" class="block  text-sm font-medium text-gray-900 ">Notes</label>
            <textarea id="message" rows="4"
            name="notes" 
            class="lock p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Write your notes here..."></textarea>
        </div>
    </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldSelect, useFieldText } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'

  defineProps<{
    id?: number
  }>()

  const name = 'kpi'
  const form = useFormStore(name)()
  const index = useIndexStore(name)()
  const FieldText = useFieldText<any>()
  const FieldSelect = useFieldSelect<any>()

  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
