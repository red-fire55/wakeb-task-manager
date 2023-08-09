<template>
   <FormModal :id="id" :name="name" filterUri="kpis" uri="kpis">
        <FieldText name="measure" label="Mesure" type="number" class="col-span-12" />
        <FieldSelect name="owner_id" label="Owner Name"  class="col-span-12"/>
        <FieldText name="target" label="Target"  class="col-span-12"/>

        <FieldText name="status" label="Status"  class="col-span-12"/>
        <FieldText name="sub_weight" label="Weight"  class="col-span-12"/>
      
        <FieldSelect name="frequency" label="Frequency" class="col-span-12" />
        
        <FieldSelect name="kpi_category_id" label="Category" class="col-span-12" />
      <TextArea name="notes" label="Notes"  class="col-span-12"/>
    </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldSelect, useFieldText, useTextArea } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'

  defineProps<{
    id?: number
  }>()

  const name = 'kpi'
  const form = useFormStore(name)()
  const index = useIndexStore('kpis')()
  const FieldText = useFieldText<any>()
  const FieldSelect = useFieldSelect<any>()
  const TextArea = useTextArea<any>()

  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
