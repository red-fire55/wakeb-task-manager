<template>
<SettingsLayout>
    <Card class="p-6">
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <Topbar :title="__('category')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
            v-if="can('user:create')"
            size="sm"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateMilestoneModal"
          >
            {{ __('create category') }}
          </TheButton>
        </div>
      </Topbar>

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
          >
            <div
              class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg"
            >
              <table class="min-w-full divide-y divide-gray-200" >
                <thead>
                  <tr>
                    <TableTh
                      name="milestone"
                      :index="indexkpiCategories"
                      :label="__('Name')"
                      sort="name"
                    />
                    <TableTh
                      name="milestone"
                      :index="indexkpiCategories"
                      :label="__('description')"
                    />
                     <TableTh
                      name="milestone"
                      :index="indexkpiCategories"
                      :label="__('action')"
                    />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="item in indexkpiCategories.data.data" :key="item.id">
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <div class="flex">
                        <div class="text-sm ltr:ml-3 rtl:mr-3">
                          <span
                            class="mb-1 block truncate text-sm font-medium leading-none text-gray-900"
                          >
                            {{ item.name }}
                          </span>
                        </div>
                      </div>
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <span>{{ item.description }}</span>
                    </td>

                     <td
                      class="whitespace-no-wrap flex items-center justify-start px-6 py-4 text-right text-sm font-medium leading-5"
                    >
                           <span
                        class="ml-2"
                        @click="openModal(item.id)"
                      >
                        <PencilSquareIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
            
                      <TrashIcon
                        class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        @click="indexMilestone.deleteIt(item.id)"
                      />
                      </td>

                  </tr>
                </tbody>
              </table>

              <IndexPagination :index="indexkpiCategories" />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    </Card>
</SettingsLayout>
</template>

<script setup lang="ts">
  import { ref, onMounted } from 'vue'
  import { useIndexStore, useModalsStore } from 'spack'
  import axios from "axios"
  import {
    IndexPagination,
    Loader,
    TableTh,
    TheButton,
    Topbar,
  } from 'thetheme'
  // import Form from '../../components/milestone/Form.vue'
  import SettingsLayout from '../SettingsLayout.vue'

  import Form from "./forms/CategoryForm.vue";
  import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'
  const indexkpiCategories = useIndexStore('kpiCategories')(),
    processing = ref(true)
  // invitations = ref([])

  checkProcessing()

  indexkpiCategories.setConfig({
    uri: 'kpiCategories',
    orderByDirection: 'desc',
  })
  indexkpiCategories.fetch()


  function checkProcessing() {
    setTimeout(function () {
      if (indexkpiCategories.fetching ) {
        checkProcessing()
        return
      }
      renderData()
    }, 150)
  }

  function renderData() {
    processing.value = false
  }

  function OpenCreateMilestoneModal(id = null) {
    useModalsStore().add(Form, { id })
  }

  function openModal(id: number | null = null) {
    useModalsStore().add(Form, { id })
  }
</script>
