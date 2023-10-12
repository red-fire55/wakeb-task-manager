import { defineComponent, watch, ref } from 'vue'
import { RouterView, useRoute } from 'vue-router'
import SidebarMobile from './SidebarMobile.vue'
import TheHeader from './Header.vue'
import TheSidebar from './Sidebar.vue'
import { FlashMessage, Modals } from 'thetheme'

export default defineComponent({
  setup() {
    let route = useRoute()
    let current_route = ref(null)
    watch(
      () => route.path,
      (val) => {
        current_route.value = val 
      })
    return () => (
      <div class="flex h-screen overflow-hidden bg-gray-100">
        <SidebarMobile />
        {current_route.value !== '/tech-radar' && <TheSidebar />}

        <div class="flex w-0 flex-1 flex-col overflow-hidden">
          <TheHeader />

          <main class="relative flex-1 overflow-y-auto px-8 py-6">
            <RouterView />
          </main>
        </div>

        <Modals />
        <FlashMessage />
      </div>
    )
  },
})
