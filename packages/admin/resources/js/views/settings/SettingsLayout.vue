<template>
  <div class="topbar flex justify-between">
    <h1 class="mb-4 text-2xl font-semibold text-gray-900">
      {{ __('Settings') }}
    </h1>
    <div>
      <slot name="topbar" />
    </div>
  </div>

  <div class="flex">
    <div class="w-64">
      <Card class="overflow-hidden">
        <nav class="py-1">
          <template v-for="nav in useSettingsNav" :key="nav.label">
            <router-link
              v-if="!nav.permission || can(nav.permission)"
              v-slot="{ href, navigate, isActive }"
              :to="nav.uri"
              custom
            >
              <a
                :href="href"
                class="block px-4 py-2 text-sm"
                :class="{
                  'bg-gray-100 font-medium text-gray-900': isActive,
                  'text-gray-700 hover:bg-gray-100 hover:text-gray-900':
                    !isActive,
                }"
                @click="navigate"
              >
                {{ __(nav.label) }}
              </a>
            </router-link>

          </template>
                <ProjectCruds />
        </nav>
      </Card>
    </div>
    <div class="flex-1 ltr:pl-6 rtl:pr-6">
      <slot />
    </div>
  </div>
</template>

<script setup lang="ts">
  import { useSettingsNav } from 'Use/settings-nav'
  import { Card } from 'thetheme'
  import ProjectCruds from "./ProjectCruds.vue"
</script>
