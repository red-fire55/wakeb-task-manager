<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <Topbar :title="__('BalanceScore')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
            v-if="can('user:create') && !indexInvitation.data.data.length"
            size="sm"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateKpisModal"
          >
            {{ __('NewKpi') }}
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
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <TableTh
                      name="milestone"
                      :index="indexUser"
                      :label="__('KpiMeasured')"
                      sort="Kpi Meaured"
                    />
                    <TableTh
                      name="Weight"
                      :index="indexUser"
                      :label="__('Weight')"
                    />
                     <TableTh
                      name="SubWeight"
                      :index="indexUser"
                      :label="__('Sub Weight')"
                    />
                     <TableTh
                      name="OwnerName"
                      :index="indexUser"
                      :label="__('Owner Name')"
                    />
                     <TableTh
                      name="Target"
                      :index="indexUser"
                      :label="__('Target')"
                    />
                    <TableTh
                      name="Result"
                      :index="indexUser"
                      :label="__('Result')"
                    />
                    <TableTh
                      name="PreviousResult"
                      :index="indexUser"
                      :label="__('Previous Result')"
                    />
                    <TableTh
                      name="Notes"
                      :index="indexUser"
                      :label="__('Notes')"
                    />
                    <TableTh
                      name="Status"
                      :index="indexUser"
                      :label="__('Status')"
                    />
                    <TableTh
                      name="Actions"
                      :index="indexUser"
                      :label="__('Actions')"
                    />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="item in indexUser.data.data" :key="item.id">
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
                      {{ item.roles[0].name }}
                    </td>
<td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.roles[0].name }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.roles[0].name }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.roles[0].name }}
                    </td>
                    <td
                      class="whitespace-no-wrap flex items-center justify-start px-6 py-4 text-right text-sm font-medium leading-5"
                    >
                      <span
                        v-if="can('user:update')"
                        class="ml-2"
                        @click="openModal(item.id)"
                      >
                        <PencilSquareIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
            
                      <TrashIcon
                        v-if="can('user:delete')"
                        class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        @click.prevent="indexUser.deleteIt(item.id)"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>

              <IndexPagination :index="indexUser" />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
  import { ref } from 'vue'
  import { useIndexStore, useModalsStore } from 'spack'
  import {
    IndexPagination,
    Loader,
    TableTh,
    TheButton,
    Topbar,
  } from 'thetheme'
  import Form from '../../components/kpi/Form.vue'
  import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'
  
  const indexUser = useIndexStore('user')(),
    indexInvitation = useIndexStore('invitation')(),
    processing = ref(true)
  // invitations = ref([])

  checkProcessing()

  indexUser.setConfig({
    uri: 'users',
    orderByDirection: 'desc',
  })
  indexUser.fetch()

  indexInvitation.setConfig({
    uri: 'invitations',
    orderByDirection: 'desc',
  })
  indexInvitation.fetch()

  function checkProcessing() {
    setTimeout(function () {
      if (indexUser.fetching || indexInvitation.fetching) {
        checkProcessing()
        return
      }

      renderData()
    }, 150)
  }

  function renderData() {
    processing.value = false
  }

  function OpenCreateKpisModal(id = null) {
    useModalsStore().add(Form, { id })
  }

  function openModal(id: number | null = null) {
    useModalsStore().add(Form, { id })
  }
</script>
