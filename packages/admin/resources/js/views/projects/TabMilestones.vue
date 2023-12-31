<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <Topbar :title="__('Milestone')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
            v-if="can('user:create')"
            size="sm"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateMilestoneModal"
          >
            {{ __("NewMilestone") }}
          </TheButton>
        </div>
      </Topbar>

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <TableTh
                      name="milestone"
                      :index="indexMilestone"
                      :label="__('Name')"
                      sort="name"
                    />
                    <TableTh name="milestone" :index="indexMilestone" label="Priority" />
                    <TableTh
                      name="milestone"
                      :index="indexMilestone"
                      :label="__('StartTime')"
                    />
                    <TableTh
                      name="milestone"
                      :index="indexMilestone"
                      :label="__('EndTime')"
                    />
                    <TableTh
                      name="Status"
                      :index="indexMilestone"
                      :label="__('Status')"
                    />
                    <TableTh
                      name="milestone"
                      :index="indexMilestone"
                      :label="__('Actions')"
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
                      {{ item.order }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.start_date }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      {{ item.end_date }}
                    </td>
                    <td
                      class="whitespace-no-wrap px-6 py-4 text-sm font-medium text-gray-500"
                    >
                      <div class="flex justify-end mb-1">
                        <span
                          class="text-xs font-medium text-gray-500 dark:text-gray-400"
                        >
                          {{ item.progress }}%</span
                        >
                      </div>
                      <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div
                          class="bg-sky-300 h-1.5 rounded-full"
                          :style="`width: ${Number(item.progress)}%`"
                        ></div>
                      </div>
                    </td>
                    <td
                      class="whitespace-no-wrap flex items-center justify-start px-6 py-4 text-right text-sm font-medium leading-5"
                    >
                      <!-- v-if="can('milestone:update')" -->
                      <span class="ml-2" @click="addNote(item.id)">
                        <DocumentTextIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>

                      <span class="ml-2" @click="openModal(item.id)">
                        <PencilSquareIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
                      <!-- v-if="can('user:delete')" -->

                      <TrashIcon
                        class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        @click="indexMilestone.deleteIt(item.id)"
                      />
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
    <!-- <div class="w-100" v-if="detail">
              <div class="w-100"  v-for="(item, i) in Object.entries(detail)" :key="i">
                {{item[0]}} : {{ item[1] }}
              </div>
              
            </div> -->
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useIndexStore, useModalsStore } from "spack";
import { IndexPagination, Loader, TableTh, TheButton, Topbar } from "thetheme";
import Form from "../../components/milestone/Form.vue";
import NoteForm from "../../components/milestone/NoteForm.vue";
import { PencilSquareIcon, TrashIcon, DocumentTextIcon } from "@heroicons/vue/24/outline";
import { useProjectDetail } from "Store/project-detail";

const indexMilestone = useIndexStore("milestone")(),
  processing = ref(true),
  project = useProjectDetail();

checkProcessing();
indexMilestone.params['project_id'] = project.data.id
indexMilestone.setConfig({
  uri: `milestone`,
  orderByDirection: "desc",
});
indexMilestone.fetch();

function checkProcessing() {
  setTimeout(function () {
    if (indexMilestone.fetching) {
      checkProcessing();
      return;
    }
    renderData();
  }, 150);
}

function renderData() {
  processing.value = false;
}

function OpenCreateMilestoneModal(id = null) {
  useModalsStore().add(Form, { id });
}

function openModal(id: number | null = null) {
  useModalsStore().add(Form, { id });
}

function addNote(id: number | null = null) {
  useModalsStore().add(NoteForm, { id });
}
</script>
