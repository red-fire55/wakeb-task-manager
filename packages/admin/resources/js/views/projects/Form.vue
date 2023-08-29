<template>
  <FormModal :name="name" uri="projects">
    <FieldText name="name" label="Name" class="col-span-12" />
    <FieldSelect name="type_id" label="Type" class="col-span-12" />
    <FieldSelect name="department_id" label="Department" class="col-span-12" />
    <DatePicker name="End Date" value="end_time" :formName="name" class="col-span-12"/>
    <FieldColor name="color" />
    <FieldChooseUsers name="users" />
  </FormModal>
</template>

<script setup lang="ts">
  import { FormModal, useFieldText, useFieldSelect, DatePicker } from 'thetheme'
  import FieldColor from 'Component/FieldColor.vue'
  import FieldChooseUsers from './FieldChooseUsers.vue'
  import { useFormStore, useIndexStore, useModalsStore } from 'spack'
  import { useProjectIndex } from 'Store/project'
  import type { ProjectForm } from 'types'

  const name = 'project'
  const form = useFormStore(name)()
  const project = useProjectIndex()
  const projectIndexStore = useIndexStore('projects')()
  const FieldText = useFieldText<ProjectForm>()
  const FieldSelect = useFieldSelect<any>()
  form.onSuccess((response) => {
    const params = new URLSearchParams(window.location.search)

    if (form.id !== null) {
      const projectItemIndex = project.items.findIndex((x) => x.id == form.id)
      project.items[projectItemIndex] = response.model

      if (!params.has('archived') && Array.isArray(projectIndexStore.data)) {
        const projectIndexStoreItemIndex = projectIndexStore.data.findIndex(
          (x) => x.id == form.id
        )
        projectIndexStore.data[projectIndexStoreItemIndex] = response.model
      }

      useModalsStore().pop()
      return
    }

    if (!params.has('archived') && Array.isArray(projectIndexStore.data)) {
      projectIndexStore.data.push(response.model)
    }

    project.items.push(response.model)
    useModalsStore().pop()
  })
</script>
