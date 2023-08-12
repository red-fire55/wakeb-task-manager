
<template>
  <section class="py-2">
    <Collapsible close>
      <template #trigger="{ open }">
        <div class="flex cursor-pointer items-center pl-3">
          
 <p
            class="px-1 text-md font-sm  text-gray-700"
          >
             Projects 
          </p>
          <svg
            viewBox="0 0 16 16"
            class="h-4 w-4 text-gray-500 ml-auto mr-2"
            :class="{ 'rotate-[270deg]': !open }"
          >
            <path
              d="M14 5.758L13.156 5 7.992 9.506l-.55-.48.002.002-4.588-4.003L2 5.77 7.992 11 14 5.758"
              fill="currentColor"
            ></path>
          </svg>
        </div>
      </template>

      <template #content>
        <div class="mt-2.5">
          <template v-for="item in crud_tables" :key="item.name">
            <RouterLink
              v-slot="{ navigate, href, route }"
              :to="`/${item.path}`"
              custom
            >
              <a
                :href="href"
                :class="[
                  isActive(item.path)
                    ? 'bg-gray-900 text-white'
                    : 'text-gray-500 hover:bg-gray-700 hover:text-white',
                  'group flex items-center rounded-md py-2 pl-7 pr-2 text-sm font-medium',
                ]"
                @click="navigate"
              >
                <span class="flex-1 truncate">{{ item.name }}</span>
              </a>
            </RouterLink>
          </template>
        </div>
      </template>
    </Collapsible>
  </section>
</template>

<script setup lang="ts">
  import { computed } from 'vue'
  import { useRouter } from 'vue-router'
  import { Collapsible } from 'thetheme'

  const router = useRouter(),
    path = computed(() => router.currentRoute.value.path)
    const crud_tables = [{name:"category", path: 'settings/Categories'}, {name:"department", path:"settings/Departments"},{name:"types", path:"settings/Types"}];

  function isActive(href: string) {
    return path.value.startsWith(href)
  }
</script>
