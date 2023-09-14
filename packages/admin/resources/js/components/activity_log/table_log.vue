<template>
  <div v-if="processing" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else>
    <section>
      <Topbar :title="__('ActivityLog')">
        <div class="ltr:ml-auto rtl:mr-auto">
          <TheButton
            size="sm"
            data-cy="topbar-invitation-create-button"
            @click="OpenCreateMilestoneModal"
          >
            {{ __("NewActivityLog") }}
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
                      name="name"
                      :index="indexUser"
                      :label="__('Name')"
                      sort="name"
                    />
                    <TableTh name="status" :index="indexUser" :label="__('Status')" />
                    <TableTh name="Users" :index="indexUser" :label="__('Users')" />
                    <TableTh name="Progress" :index="indexUser" :label="__('Progress')" />
                    <TableTh name="end time" :index="indexUser" :label="__('EndTime')" />
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr
                    class="border-b hover:bg-gray-100"
                    v-for="(project, i) in projects"
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
                        class="bg-sky-300 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded"
                        >{{ project.status }}</span
                      >
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">
                      <div class="flex -space-x-4 w-28">
                        <img
                          v-for="(user, i) in project.users"
                          :key="i"
                          :src="user.avatar"
                          alt=""
                          class="w-10 h-10 flex-shrink-0 border-2 border-white rounded-full"
                        />
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
                          style="width: 75%"
                        ></div>
                      </div>
                    </td>
                    <td
                      class="px-4 py-2 whitespace-nowrap font-medium text-gray-900 text-xs"
                    >
                      {{ project.human_end_time }}
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
import { ref } from "vue";
import { useIndexStore, useModalsStore, axios } from "spack";
import { IndexPagination, Loader, TableTh, TheButton, Topbar } from "thetheme";
import Form from "../../components/milestone/Form.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

const projects = ref<any>([]);

axios.get("recent-projects").then((response) => {
  projects.value = response.data;
});
const indexUser = useIndexStore("user")(),
  indexInvitation = useIndexStore("invitation")(),
  processing = ref(true);
// invitations = ref([])

checkProcessing();

indexUser.setConfig({
  uri: "users",
  orderByDirection: "desc",
});
indexUser.fetch();

indexInvitation.setConfig({
  uri: "invitations",
  orderByDirection: "desc",
});
indexInvitation.fetch();

function checkProcessing() {
  setTimeout(function () {
    if (indexUser.fetching || indexInvitation.fetching) {
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
</script>
