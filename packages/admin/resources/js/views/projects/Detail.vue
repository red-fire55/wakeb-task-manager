<template>
  <div v-if="project.fetching" class="mt-8 flex justify-center">
    <Loader size="40" color="#5850ec" />
  </div>

  <div v-else class="flex h-full flex-col">
    <div class="flex items-center pb-4">
      <div class="flex items-center">
        <span
          class="block h-2.5 w-2.5 rounded-full ltr:mr-3 rtl:ml-3"
          :style="{ 'background-color': project.data.meta.color }"
        ></span>
        <h1 class="text-2xl font-semibold text-gray-900" data-cy="page-title">
          {{ project.data.name }}
        </h1>
      </div>

      <span
        class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-8 rtl:mr-8"
        :class="{ 'bg-gray-200 text-gray-800': tab.active == 0 }"
        @click="tab.select(0)"
      >
        <ViewColumnsIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
          class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >{{ __('Board') }}</span
        >
      </span>
       <!-- overview tab-->
        <span
            class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-8 rtl:mr-8"
            :class="{ 'bg-gray-200 text-gray-800': tab.active == 1 }"
            @click="tab.select(1)"
        >
        <ViewfinderCircleIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
            class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
        >{{ __('Overview') }}</span
        >
      </span>

      <span
        class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-8 rtl:mr-8"
        :class="{ 'bg-gray-200 text-gray-800': tab.active == 2 }"
        @click="tab.select(2)"
      >
        <AdjustmentsHorizontalIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
          class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >{{ __('Milestone') }}</span
        >
      </span>

      <span
        class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-8 rtl:mr-8"
        :class="{ 'bg-gray-200 text-gray-800': tab.active == 3 }"
        @click="tab.select(3)"
      >
        <ArrowPathIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
          class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >{{ __('ActivityLog') }}</span
        >
      </span>

      <span
        class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-2 rtl:mr-2"
        :class="{ 'bg-gray-200 text-gray-800': tab.active == 4 }"
        @click="tab.select(4)"
      >
        <ClockIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
          class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >{{ __('Time Logs') }}</span
        >
      </span>

      <span
        class="group flex cursor-pointer items-center rounded-md px-3 py-2 text-gray-700 ltr:ml-2 rtl:mr-2"
        :class="{ 'bg-gray-200 text-gray-800': tab.active == 5 }"
        @click="tab.select(5)"
      >
        <ClockIcon class="h-4 w-4 group-hover:text-gray-800" />
        <span
          class="text-sm font-medium group-hover:text-gray-800 ltr:ml-2 rtl:mr-2"
          >{{ __('BalanceScore') }}</span
        >
      </span>

      <div class="flex flex-shrink-0 -space-x-1 ltr:ml-8 rtl:mr-8">
        <UserAvatar
          v-for="user in project.data.users"
          :key="user.id"
          class="h-6 w-6 max-w-none rounded-full ring-2 ring-white"
          :avatar="user.avatar"
          data-cooltipz-dir="bottom"
          :aria-label="user.name"
        />
      </div>

      <DetailMenu
        :project-id="project.data.id || 0"
        :is-favorite="project.data.is_favorite"
      />
    </div>

    <Component :is="tab.tab" />
  </div>
</template>

<script setup lang="ts">
  import { markRaw } from 'vue'
  import { Loader, UserAvatar } from 'thetheme'
  import { useProjectDetail } from 'Store/project-detail'
  import { useRoute } from 'vue-router'
  import { useModalsStore, useTabStore } from 'spack'
  import TabBoard from './TabBoard.vue'
  import TabOverview from "View/projects/TabOverview.vue";
  import TabMilestones from './TabMilestones.vue'
  import DetailMenu from './DetailMenu.vue'
  import TabTimeLogs from './TabTimeLogs.vue'
  import TabKpi from './TabKpi.vue'
  import { ClockIcon, ViewColumnsIcon,ViewfinderCircleIcon, AdjustmentsHorizontalIcon,ArrowPathIcon } from '@heroicons/vue/24/outline'
  import { onBeforeRouteUpdate } from 'vue-router'
  import TaskModal from 'View/task/TaskModal.vue'
  import type { ConcreteComponent } from 'vue'
  import TabLog from "View/projects/TabLog.vue";

  const project = useProjectDetail(),
    route = useRoute()

  onBeforeRouteUpdate((to, from) => {
    if (to.params.id !== from.params.id) {
      project.fetch(to.params.id as string)
    }
  })

  const tab = useTabStore('project-detail')()

  tab.tabs([
    { component: markRaw(TabBoard), label: 'Board' },
    { component: markRaw(TabOverview), label: 'Board' },
    { component: markRaw(TabMilestones), label: 'Milestones' },
    { component: markRaw(TabLog), label: 'ActivityLog' },
    { component: markRaw(TabTimeLogs), label: 'Time Logs' },
    { component: markRaw(TabKpi), label: 'Kpi' },
  ])

  tab.select(2)

  project.fetch(route.params.id as string)

  function openModal(id: string) {
    useModalsStore().add(TaskModal as ConcreteComponent, { id: parseInt(id) })
  }

  if (route.params.taskId) {
    const id = route.params.taskId as string
    openModal(id)
  }
</script>
