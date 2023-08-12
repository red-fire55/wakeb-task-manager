<template>
  <FormModal :id="id" :name="name" uri="milestone">
    <FieldText name="name" label="Name" class="col-span-12" />
    <FieldText name="order" label="Order" class="col-span-12" type="number" />
    <DatePicker name="Start Date" value="start_date" :formName="name" class="col-span-12"/>
    <DatePicker name="End Date" value="end_date" :formName="name" class="col-span-12"/>
  </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldSelect, useFieldText, DatePicker } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'
  import {useProjectDetail} from "Store/project-detail";

  defineProps<{
    id?: number
  }>()

  const name = 'milestone'
  const form = useFormStore(name)()
  const index = useIndexStore(name)()
  const FieldText = useFieldText<any>()
  const FieldSelect = useFieldSelect<any>()
  const project = useProjectDetail()
  setTimeout(()=>{
    form.data['project_id'] = project.data.id
  }, 500)
  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
