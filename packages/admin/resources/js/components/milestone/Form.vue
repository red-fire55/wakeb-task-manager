<template>
  <FormModal :id="id" :name="name" uri="milestone">
    <FieldText name="name" label="Name" class="col-span-12" />
    <FieldSelect :multiple="true" name="tasks" label="Tasks" class="col-span-12" />
    <FieldText name="order" label="Order" class="col-span-12" type="number" />
    <FieldText name="start_date" label="Start Date" class="col-span-12" />
    <FieldText name="end_date" label="End Date" class="col-span-12" />
  </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldSelect, useFieldText } from 'thetheme'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'

  defineProps<{
    id?: number
  }>()

  const name = 'milestone'
  const form = useFormStore(name)()
  const index = useIndexStore(name)()
  const FieldText = useFieldText<any>()
  const FieldSelect = useFieldSelect<any>()

  form.onSuccess(() => {
    index.fetch()
    useModalsStore().pop()
  })
</script>
