<template>
    <div class="hidden lg:block lg:col-span-3 xl:col-span-2">
        <nav aria-label="Sidebar" class="sticky top-4 divide-y divide-gray-300">
            <div class="pb-8 space-y-1">
                <a v-for="item in navigation" :key="item.name" :href="item.href"
                   :class="[item.current ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md']"
                   :aria-current="item.current ? 'page' : undefined">
                    <component :is="item.icon"
                               :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']"
                               aria-hidden="true"/>
                    <span class="truncate">
                                  {{ item.name }}
                                </span>
                </a>
            </div>
            <div class="pt-10">
                <div class="mt-3 space-y-2" aria-labelledby="communities-headline">
                    <a v-for="community in communities" :key="community.name" :href="community.href"
                       class="group flex items-center px-3 py-2 text-sm font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50">
                                  <span class="truncate">
                                    {{ community.name }}
                                  </span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</template>
<script>

import {ClockIcon, HomeIcon, TrendingUpIcon, ArchiveIcon, InboxInIcon} from "@heroicons/vue/outline/esm";

const navigation = [
    {name: 'Notele mele', href: '/dashboard', icon: HomeIcon, current: true},
    {name: 'Inbox', href: '#', icon: InboxInIcon, current: false},
    {name: 'Istoric', href: '#', icon: ClockIcon, current: false},
    {name: 'Rapoarte', href: '#', icon: TrendingUpIcon, current: false},
    {name: 'Arhiva', href: '#', icon: ArchiveIcon, current: false},
]

const communities = [
    {name: 'Cele mai prioritare', href: '#'},
    {name: 'Cele mai active', href: '#'},
    {name: 'Echipa mea', href: '#'},
]

export default {
    name: "LeftSidebar",
    data() {
        return {
            navigation,
            communities
        }
    }
}
</script>

<style scoped>

</style>
