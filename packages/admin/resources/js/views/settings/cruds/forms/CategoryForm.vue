<template>
   <FormModal :id="id" :name="name" filterUri="kpiCategories" uri="kpiCategories">
        <FieldText name="name" label="name"  class="col-span-12" />
       <FieldText name="name_ar" label="arabic name"  class="col-span-12" />

      <TextArea name="description" label="description"  class="col-span-12"/>
    </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldSelect, useFieldText, useTextArea } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'

  defineProps<{
    id?: number
  }>()

  const name = 'kpi Category'
  const form = useFormStore(name)()
  const index = useIndexStore('kpiCategories')()
  const FieldText = useFieldText<any>()
  const FieldSelect = useFieldSelect<any>()
  const TextArea = useTextArea<any>()

  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
