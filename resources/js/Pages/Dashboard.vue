<template>
    <main-layout>
        <template #left-sidebar>
            <left-sidebar/>
        </template>

        <template #right-sidebar>
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
        <div class="mt-4">
            <h1 class="sr-only">Recent </h1>
            <ul class="space-y-4">
                <li v-for="task in tasks" :key="task.id"
                    class="bg-white px-4 py-6 shadow sm:p-6 sm:rounded-lg">
                    <article :aria-labelledby="'task-title-' + task.id">
                        <div>
                            <div class="flex flex-col space-x-3">
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-900">
                                        <!--                                        task.department_path-->
                                        <department-breadcrumbs :departments="task.department_path"/>
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col space-x-3">
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-900">
                                        {{ task.created }}
                                    </p>
                                </div>
                            </div>
                            <h2 :id="'task-title-' + task.id"
                                class="mt-4  font-bold text-xl text-gray-900">
                                <inertia-link :href="`/note/${task.id}/${task.title}`" class="hover:underline">
                                    {{ task.title }}
                                </inertia-link>
                            </h2>
                            <div class="flex flex-col space-x-3">
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-900">
                                        {{ task.assigned_to }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-700 space-y-4" v-html="task.description"/>
                            <div class="flex mt-2 flex-col space-x-3 justify-center">
                                <div class="min-w-0 flex-1 align-middle items-center">
                                    <span class="text-md font-bold text-red-600">
                                        Atentie : Expira in {{ task.expires_at }} zile
                                    </span>
                                    <inertia-link :href="`/note/${task.id}/${task.title}`"
                                                  class="text-sm font-bold text-gray-600 float-right hover:underline cursor-pointer">
                                        Deschide >>
                                    </inertia-link>
                                </div>
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        </div>
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

const tabs = [
    {name: 'Noi', href: '#', current: true},
    {name: 'Expira', href: '#', current: false},
    {name: 'Prioritare', href: '#', current: false},
    {name: 'Toate', href: '#', current: false}
]

export default {
    components: {
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
