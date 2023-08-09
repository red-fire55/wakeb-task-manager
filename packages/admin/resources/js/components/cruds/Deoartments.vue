<template>
    <div v-if="processing" class="mt-8 flex justify-center">
        <Loader size="40" color="#5850ec" />
    </div>
    <div v-else>
        <section>
            <Topbar :title="__('department')">
                <div class="ltr:ml-auto rtl:mr-auto">
                    <TheButton
                        v-if="can('user:create')"
                        size="sm"
                        data-cy="topbar-invitation-create-button"
                        @click="OpenCreateMilestoneModal"
                    >
                        {{ __('create department') }}
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
                            <table class="min-w-full divide-y divide-gray-200" uri="">
                                <thead>
                                <tr>
                                    <TableTh
                                        name="milestone"
                                        :index="indexMilestone"
                                        :label="__('Name')"
                                        sort="name"
                                    />
                                    <TableTh
                                        name="milestone"
                                        :index="indexMilestone"
                                        :label="__('description')"
                                    />
                                    <TableTh
                                        name="milestone"
                                        :index="indexMilestone"
                                        :label="__('action')"
                                    />
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="item in indexMilestone.data.data" :key="item.id">
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
                                        <span v-for="(item, i) in item.tasks" :key="i">{{ item.title }}</span>
                                    </td>

                                    <td
                                        class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                                    >
                                        <span v-for="(item, i) in item.tasks" :key="i">{{ item.title }}</span>
                                    </td>

                                </tr>
                                </tbody>
                            </table>

                            <IndexPagination :index="indexMilestone" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
import Form from "Component/cruds/forms/DepartmentForm.vue";
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'


const indexMilestone = useIndexStore('milestone')(),
    processing = ref(true)
// invitations = ref([])

checkProcessing()

indexMilestone.setConfig({
    uri: 'milestone',
    orderByDirection: 'desc',
})
indexMilestone.fetch()


function checkProcessing() {
    setTimeout(function () {
        if (indexMilestone.fetching ) {
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
