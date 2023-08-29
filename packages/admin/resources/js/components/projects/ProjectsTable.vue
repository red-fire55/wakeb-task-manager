<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead>
                  <tr>
                    <TableTh
                      name="name"
                      :index="indexProjects"
                      :label="__('Name')"
                      sort="name"
                    />
                    <TableTh name="status" :index="indexProjects" :label="__('Status')" />
                    <TableTh name="Users" :index="indexProjects" :label="__('Users')" />
                    <TableTh name="Progress" :index="indexProjects" :label="__('Progress')" />
                    <TableTh name="end time" :index="indexProjects" :label="__('EndTime')" />
                    <TableTh name="end time" :index="indexProjects" :label="__('Actions')" />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr
                    class="border-b hover:bg-gray-100"
                    v-for="(project, i) in indexProjects.data"
                    :key="i"
                  >
                    <th
                      scope="row"
                      class="px-4 py-6 font-medium text-gray-900 whitespace-nowrap text-left"
                    >
                      {{ project.name }}
                    </th>
                    <td class="px-4 py-2 whitespace-nowrap">
                      <span
                        :class="project.progress < 100 ? 'bg-sky-300 text-white text-xs font-medium px-2.5 py-0.5 rounded':
                        'bg-green-300 text-white text-xs font-medium px-2.5 py-0.5 rounded'"
                        >{{ project.progress < 100 ? 'in progress' : 'completed' }}</span
                      >
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                      <div class="flex -space-x-4 w-28">
                        <template v-for="(user, i) in project.users">
                          <img
                            :key="i"
                            :src="user.avatar"
                            alt=""
                            class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full"
                            v-if="user.avatar"
                          />
                          <a
                            :key="i+1"
                            href="#"
                            class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900 border-2 border-white rounded-full hover:bg-gray-600"
                            v-else
                            >-</a
                          >
                        </template>
                        <!-- <a
                          href="#"
                          class="flex-shrink-0 flex items-center justify-center w-10 h-10 text-xs font-medium text-white bg-gray-900 border-2 border-white rounded-full hover:bg-gray-600"
                          >+5</a
                        > -->
                      </div>
                    </td>
                    <td class="px-4 py-2 font-medium whitespace-nowrap">
                      <div class="flex justify-end mb-1">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400"
                          >{{ project.progress }}%</span
                        >
                      </div>
                      <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div
                          class="bg-sky-300 h-1.5 rounded-full"
                          :style="`width: ${Number(project.progress)}%`"
                        ></div>
                      </div>
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 text-xs"
                    >
                      {{ project.end_time }}
                    </td>
                    <td
                      class="whitespace-no-wrap flex items-center justify-start px-6 py-4 text-right text-sm font-medium leading-5"
                    >
                      <span
                        class="ml-2"
                        @click="openModal(project.id)"
                      >
                        <PencilSquareIcon
                          class="w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        />
                      </span>
                        <!-- v-if="can('user:delete')" -->
            
                      <TrashIcon
                        class="ml-2 w-5 cursor-pointer text-gray-400 hover:text-gray-800"
                        @click="indexProjects.deleteIt(project.id)"
                      />
                    </td>
                  </tr>
                </tbody>
              </table>

              <IndexPagination :index="indexProjects" />
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useIndexStore, useModalsStore, axios } from "spack";
import { IndexPagination, Loader, TableTh, TheButton, Topbar } from "thetheme";
import Form from "../../views/projects/Form.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

const indexProjects = useIndexStore("all-projects")(),
  processing = ref(true);

checkProcessing();

indexProjects.setConfig({
  uri: "projects",
  orderByDirection: "desc",
});
indexProjects.fetch();

function checkProcessing() {
  setTimeout(function () {
    if (indexProjects.fetching) {
      checkProcessing();
      return;
    }
    renderData();
  }, 150);
}

function renderData() {
  processing.value = false;
  localStorage.setItem("projects", indexProjects.data)
}


function openModal(id: number | null = null) {
  useModalsStore().add(Form, { id });
}
</script>
