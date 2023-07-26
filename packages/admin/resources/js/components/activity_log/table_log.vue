<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <Topbar :title="__('ActivityLog')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
            v-if="can('user:create') && !indexInvitation.data.data.length"
            size="sm"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateMilestoneModal"
          >
            {{ __('NewActivityLog') }}
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
                      name="task"
                      :index="indexUser"
                      :label="__('Task')"
                      sort="task"
                    />
                    <TableTh
                      name="status"
                      :index="indexUser"
                      :label="__('Status')"
                    />
                     <TableTh
                      name="Users"
                      :index="indexUser"
                      :label="__('Users')"
                    />
                     <TableTh
                      name="Progress"
                      :index="indexUser"
                      :label="__('Progress')"
                    />
                     <TableTh
                      name="preview"
                      :index="indexUser"
                      :label="__('Preview')"
                    />
                    <TableTh
                      name="time tracking"
                      :index="indexUser"
                      :label="__('TimeTracking')"
                    />
                    <TableTh
                      name="end time"
                      :index="indexUser"
                      :label="__('EndTime')"
                    />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                 <tr class="border-b hover:bg-gray-100 ">
                            <th scope="row" class="px-4 py-6 font-medium text-gray-900 whitespace-nowrap text-left">   task 1
                            </th>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="bg-sky-300 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded ">In progress</span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex -space-x-4 w-28">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-10.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-1.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-3.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full ">
                                    <a href="#" class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900  border-2 border-white rounded-full hover:bg-gray-600 ">+5</a>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                <div class="flex justify-end mb-1">
                                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 ">
                                    <div class="bg-sky-300 h-1.5 rounded-full" style="width: 75%"></div>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="#" class="font-medium text-white  hover:underline inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    Website
                                </a>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap">
                                <div class="px-2 py-1 border  bg-white rounded-lg text-xs font-medium inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" class="h-4 w-4 mr-1 text-gray-400" viewbox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                                    </svg>
                                    <span class="text-green-500">6:47</span>
                                    /8:00
                                    <button class="bg-orange-500 hover:bg-orange-700 text-white p-1 rounded-md ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 01.75-.75H9a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H7.5a.75.75 0 01-.75-.75V5.25zm7.5 0A.75.75 0 0115 4.5h1.5a.75.75 0 01.75.75v13.5a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75V5.25z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900  text-xs">23 Nov 2022</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-100 ">
                            <th scope="row" class="px-4 py-6 font-medium text-gray-900 whitespace-nowrap text-left ">Crossplatform analysis</th>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Completed</span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="flex -space-x-4 w-28">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-6.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-7.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/avatar-2.png" alt="" class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full">
                                    <a href="#" class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900  border-2 border-white rounded-full hover:bg-gray-600 ">+2</a>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                <div class="flex justify-end mb-1">
                                    <span class="text-xs font-medium text-gray-500 ">100%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 ">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: 100%"></div>
                                </div>
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                    Website
                                </a>
                            </td>
                            <td class="px-4 py-2 text-gray-900 whitespace-nowrap ">
                                <div class="px-2 py-1 border  bg-white  rounded-lg text-xs font-medium inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" class="h-4 w-4 mr-1 text-gray-400" viewbox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                                    </svg>
                                    7:00
                                    <button class="bg-green-500 text-white p-1 rounded-md ml-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4" aria-hidden="true">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900  text-xs">03 Nov 2022</td>
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
  import Form from '../../components/milestone/Form.vue'
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

  function OpenCreateMilestoneModal(id = null) {
    useModalsStore().add(Form, { id })
  }

  function openModal(id: number | null = null) {
    useModalsStore().add(Form, { id })
  }
</script>

