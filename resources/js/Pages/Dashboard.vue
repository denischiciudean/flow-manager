<template>
    <main-layout>
        <template #left-sidebar>
            <left-sidebar/>
        </template>

        <template #right-sidebar v-if="$page.props.messages.length">
            <right-sidebar/>
        </template>

        <div class="px-4 sm:px-0">
            <div class="sm:hidden">
                <label for="task-tabs" class="sr-only">Select a tab</label>
                <select id="task-tabs"
                        class="block w-full rounded-md border-gray-300 text-base font-medium text-gray-900 shadow-sm focus:border-rose-500 focus:ring-rose-500">
                    <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">
                        {{ tab.name }}
                    </option>
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="relative z-0 rounded-lg shadow flex divide-x divide-gray-200" aria-label="Tabs">
                    <a v-for="(tab, tabIdx) in tabs" :key="tab.name" :href="tab.href"
                       :aria-current="tab.current ? 'page' : undefined"
                       :class="[tab.current ? 'text-gray-900' : 'text-gray-500 hover:text-gray-700', tabIdx === 0 ? 'rounded-l-lg' : '', tabIdx === tabs.length - 1 ? 'rounded-r-lg' : '', 'group relative min-w-0 flex-1 overflow-hidden bg-white py-4 px-6 text-sm font-medium text-center hover:bg-gray-50 focus:z-10']">
                        <span>{{ tab.name }}</span>
                        <span aria-hidden="true"
                              :class="[tab.current ? 'bg-rose-500' : 'bg-transparent', 'absolute inset-x-0 bottom-0 h-0.5']"/>
                    </a>
                </nav>
            </div>
        </div>
<!--        <div class="bg-white shadow overflow-hidden sm:rounded-md mt-5">-->
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
                <task-list-item :task="task" v-for="task in tasks" :key="task.id" />
            </ul>
<!--        </div>-->
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import LeftSidebar from "@/Layouts/_partials/LeftSidebar";
import RightSidebar from "@/Layouts/_partials/RightSidebar";

import DepartmentBreadcrumbs from "@/Pages/DashboardPartials/DepartmentBreadcrumbs";

import {
    FireIcon,
    HomeIcon,
    TrendingUpIcon,
    UserGroupIcon,
    StarIcon,
    FlagIcon,
    EyeIcon,
    DotsVerticalIcon,
    ThumbUpIcon,
    ChatAltIcon,
    CodeIcon
} from "@heroicons/vue/outline/esm";

import {Menu, MenuItem, MenuButton, MenuItems} from "@headlessui/vue";
import TaskListItem from "../Components/Tasks/TaskListItem";

const tabs = [
    {name: 'Noi', href: '#', current: true},
    {name: 'Expira', href: '#', current: false},
    {name: 'Prioritare', href: '#', current: false},
    {name: 'Toate', href: '#', current: false}
]

export default {
    components: {
        TaskListItem,
        DepartmentBreadcrumbs,
        MainLayout,
        LeftSidebar,
        RightSidebar,
        Menu,
        MenuItem,
        MenuButton,
        MenuItems,
        StarIcon,
        FlagIcon,
        EyeIcon,
        DotsVerticalIcon,
        CodeIcon,
        ThumbUpIcon,
        ChatAltIcon,
    },

    props: {
        auth: Object,
        errors: Object,
        tasks: Array
    },
    data() {
        return {
            tabs
        }
    },
    mounted() {
        console.log(this.tasks)
    }
}
</script>
