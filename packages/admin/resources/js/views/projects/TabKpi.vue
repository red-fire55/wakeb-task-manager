<template>
    <div v-if="processing" class="mt-8 flex justify-center">
        <Loader size="40" color="#5850ec"/>
    </div>

  <div v-else>
    <section>
      <Topbar :title="__('BalanceScore')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
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
                                        name="Measure"
                                        :index="indexKpis"
                                        :label="__('KpiMeasured')"
                                        sort="Kpi Meaured"
                                    />
                                    <TableTh
                                        name="Weight"
                                        :index="indexKpis"
                                        :label="__('Weight')"
                                    />
                                    <TableTh
                                                          name="Sub Weight"
                                                          :index="indexKpis"
                                                          :label="__('Sub Weight')"
                                                        />
                                    <TableTh
                                        name="Owner Name"
                                        :index="indexKpis"
                                        :label="__('Owner Name')"
                                    />
                                    <TableTh
                                        name="Target"
                                        :index="indexKpis"
                                        :label="__('Target')"
                                    />
                                    <TableTh
                                        name="Result"
                                        :index="indexKpis"
                                        :label="__('Result')"
                                    />

                                    <TableTh
                                        name="Notes"
                                        :index="indexKpis"
                                        :label="__('Notes')"
                                    />
                                    <TableTh
                                        name="Status"
                                        :index="indexKpis"
                                        :label="__('Status')"
                                    />
                                    <TableTh
                                        name="Actions"
                                        :index="indexKpis"
                                        :label="__('Actions')"
                                    />
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="item in indexKpis.data.data" :key="item.id">
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        <div class="flex">
                                            <div class="text-sm ltr:ml-3 rtl:mr-3">
                          <span
                              class="mb-1 block truncate text-sm font-medium leading-none text-gray-900"
                          >
                            {{ item.measure }}
                          </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        <!-- {{ item.roles[0].name } -->
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item.sub_weight }}
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item?.owner?.name }}
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item.target }}
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item.result }}
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item.notes }}
                                    </td>
                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        {{ item.status }}
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
                                            v-if="can('user:delete')"
                                            class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                                            @click.prevent="indexKpis.deleteIt(item.id)"
                                        />
<span
                                            class="ml-2"
                                            @click="OpenCreateKpisResultModal(item.id)"
                                        >
                        <PlusCircleIcon
                            class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <IndexPagination :index="indexKpis"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup lang="ts">
import {ref} from 'vue'
import {useIndexStore, useModalsStore} from 'spack'
import {
    IndexPagination,
    Loader,
    TableTh,
    TheButton,
    Topbar,
} from 'thetheme'
import  Form from "@/components/kpi/Form.vue"
import  ResultForm from "@/components/kpi/addKpiResult.vue"
import {PencilSquareIcon, TrashIcon,PlusCircleIcon} from '@heroicons/vue/24/outline'

const indexKpis = useIndexStore('kpis')(),
    processing = ref(true)
checkProcessing()
indexKpis.setConfig({
    uri: 'kpis',
    filterUri: 'kpis',
    orderByDirection: 'desc',
})
indexKpis.fetch()
function checkProcessing() {
    setTimeout(function () {
        if (indexKpis.fetching) {
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
 function OpenCreateKpisResultModal(id = null) {
    useModalsStore().add(ResultForm, { id })
  }

function openModal(id: number | null = null) {
    useModalsStore().add(Form, {id})
}

</script>
