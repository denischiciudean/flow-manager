<template>
    <li class="bg-white px-4 py-6 shadow sm:p-6 sm:rounded-lg mt-2">
        <inertia-link :href="`/note/${task.id}/${task.title}`">
            <article :aria-labelledby="'task-title-' + task.id">
                <div>
                    <div class="flex flex-col space-x-3">
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-medium text-gray-900">
                                <!--                                        task.department_path-->
                                <department-breadcrums :departments="task.department_path"/>
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
                                    <span class="text-md font-bold text-red-600" v-if="task.expires_at > 0">
                                        Atentie : Expira in {{ task.expires_at }} zile
                                    </span>
                            <span class="text-md font-bold text-red-600" v-else-if="task.expires_at == 0">
                                                Atentie expira <span class="underline italic">astazi</span>
                            </span>
                            <span class="text-md font-bold text-red-600" v-else-if="task.expires_at < 0">
                                        Expirat de {{ (-1 * task.expires_at) }} zile
                                    </span>
                            <inertia-link :href="`/note/${task.id}/${task.title}`"
                                          class="text-sm font-bold text-gray-600 float-right hover:underline cursor-pointer">
                                Deschide >>
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </article>
        </inertia-link>

    </li>
</template>

<script>
import DepartmentBreadcrums from '../../Pages/DashboardPartials/DepartmentBreadcrumbs'

export default {
    components: {
        DepartmentBreadcrums
    },
    props: ['task'],
    name: "TaskListItem"
}
</script>

<style scoped>

</style>
