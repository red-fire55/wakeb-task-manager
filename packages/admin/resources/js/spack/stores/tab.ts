import { defineStore } from 'pinia'

export const useTabStore = function (name: string) {
  return defineStore({
    id: 'tab-' + name,

    state: (): { active: number; items: any; tab: number | null } => ({
      active: 0,
      items: [],
      tab: null,
    }),

    actions: {
      select(index: number) {
        this.active = index
        this.tab = this.items[index].component
      },

      tabs(tabs: any) {
        this.active = 0
        this.items = tabs
        this.tab = tabs[0].component
      },
    },
  })
}
