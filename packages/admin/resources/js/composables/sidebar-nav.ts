import { HomeIcon, InboxIcon, UserIcon, SignalIcon, ChartBarIcon } from '@heroicons/vue/24/outline'
import type { SidebarNav } from '@/types'

export const useSidebarNav: SidebarNav[] = [
  { label: 'Home', uri: '/', icon: HomeIcon },
  { label: 'My Tasks', uri: '/tasks', icon: InboxIcon },
  {
    label: 'Team Members',
    uri: '/users',
    icon: UserIcon,
    permission: 'user:view',
  },
  {
    label: 'Technology Radar',
    uri: '/tech-radar',
    icon: SignalIcon,
  },
  {
    label: 'Balance Score',
    uri: '/balance-score',
    icon: ChartBarIcon,
  },
]
