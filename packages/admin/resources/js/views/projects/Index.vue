<template>
  <div class="mb-4 flex">
    <h1 class="text-2xl font-semibold text-gray-900">{{ __('Projects') }}</h1>

    <div class="flex items-center ltr:ml-auto rtl:mr-auto">
      <nav class="flex space-x-2 rounded-md" aria-label="Tabs">
        <span
          class="group flex cursor-pointer items-center rounded-md px-3 py-2"
          :class="{
            'bg-gray-200 text-gray-800': !isArchived,
            'text-gray-600': isArchived,
          }"
          @click="choose()"
        >
          <FolderIcon class="h-4 w-4 group-hover:text-gray-800" />
          <span
            class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >
            {{ __('Active') }}
          </span>
        </span>

        <span
          class="group flex cursor-pointer items-center rounded-md px-3 py-2"
          :class="{
            'bg-gray-200 text-gray-800': isArchived,
            'text-gray-600': !isArchived,
          }"
          @click="choose('archived')"
        >
          <ArchiveBoxIcon class="h-4 w-4 group-hover:text-gray-800" />
          <span
            class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >
            {{ __('Archived') }}
          </span>
        </span>
      </nav>

      <TheButton
        v-if="can('project:create')"
        class="ml-6"
        size="sm"
        data-cy="topbar-create-button"
        @click.stop="project.create"
      >
        {{ __('Create Project') }}
      </TheButton>
    </div>
  </div>

  <div v-if="index.fetching" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <IndexNoData v-if="!index.data.length" no-create />

   <ProjectsTable />
  </div>
</template>

<script setup lang="ts">
  import { Card, TheButton } from 'thetheme'
  import {
    ArchiveBoxIcon,
    ArchiveBoxXMarkIcon,
    FolderIcon,
    TrashIcon,
  } from '@heroicons/vue/24/outline'
  import { axios, useConfirmStore, useIndexStore } from 'spack'
  import { IndexNoData, Loader } from 'thetheme'
  import { ref } from 'vue'
  import { useProjectIndex } from 'Store/project'
  import ProjectsTable from "../../components/projects/ProjectsTable.vue"

  const params = new URLSearchParams(window.location.search)
  const isArchived = ref(params.has('archived') ? true : false),
    index = useIndexStore('projects')(),
    project = useProjectIndex()

  if (params.has('archived')) {
    index.setConfig({ uri: 'projects?archived' })
  } else {
    index.setConfig({ uri: 'projects' })
  }

  index.fetch()

  function choose(type: null | string = null) {
    type == 'archived'
      ? index.setConfig({ uri: 'projects?archived' })
      : index.setConfig({ uri: 'projects' })

    if (type == 'archived') {
      isArchived.value = true
      history.replaceState(history.state, '', '?archived')
    } else {
      isArchived.value = false
      history.replaceState(history.state, '', '/projects')
    }

    index.fetch()
  }

  function archive(id: number, itemIndex: number) {
    axios.patch(`projects/${id}/archive`).then(() => {
      // useToastStore().flash(data.message)
      // window.location.href = '/'
      index.data.splice(itemIndex, 1)
    })
  }

  function restore(id: number, itemIndex: number) {
    axios.patch(`projects/${id}/restore`).then(() => {
      // project.items.push(data)
      index.data.splice(itemIndex, 1)
    })
  }

  function onDelete(ids: number | number[], itemIndex: number) {
    const confirm = useConfirmStore()

    confirm.confirm({
      title: 'Delete Resource',
      description: 'Are you sure you want to delete this resource?',
      button: 'Delete',
      danger: true,
      onProceed() {
        const items: number[] = Array.isArray(ids) ? ids : [ids]

        const proceedUri = 'projects'

        axios
          .delete(`${proceedUri}/null`, {
            data: { items },
          })
          .then(() => {
            confirm.hide()
            index.data.splice(itemIndex, 1)
            // fetch()
            // useFlashStore().flash(data.message)
          })
          .catch(() => {
            // useFlashStore().danger(error.response.data.message)

            confirm.hide()
          })
      },
    })
  }

  // function onDelete() {
  //   axios.delete(`projects/${props.id}`).then(() => {
  //     archive.items.splice(props.index, 1)
  //   })
  // }
</script>
