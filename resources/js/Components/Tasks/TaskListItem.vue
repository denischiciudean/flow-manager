<template>
    <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200 mt-5">
        <inertia-link :href="`/note/${task.id}/${task.title}`">
            <article :aria-labelledby="'task-title-' + task.id" class="flex flex-col h-full">
                <div class="w-full h-full px-3 py-4">
                    <div :id="'task-title-' + task.id"
                         class="font-bold text-lg my-auto flex justify-between items-center">
                        <inertia-link :href="`/note/${task.id}/${task.title}`"
                                      class="rounded-lg hover:underline text-gray-700">
                            {{ task.title }}
                        </inertia-link>

                    </div>
                    <div class="mt-2 text-sm text-gray-700 space-y-4" v-if="task.description != ' '"
                         v-html="task.description"/>
                    <div v-else class="mt-2 text-sm text-gray-700 space-y-4">
                        Fara descriere
                    </div>
                    <!--                            <div class="flex mt-1 flex-col space-x-3 justify-center">-->
                    <!--                                <div class="min-w-0 flex-1 align-middle items-center">-->
                    <!--                                    <inertia-link :href="`/note/${task.id}/${task.title}`"-->
                    <!--                                                  class="text-sm font-bold text-gray-600 float-right hover:underline cursor-pointer">-->
                    <!--                                        Deschide >>-->
                    <!--                                    </inertia-link>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                </div>
                <div class="w-full h-full ">
                    <!--                <ul class="divide-y divide-none text-center font-bold">-->
                    <div class="flex flex-col w-full ">
                        <div class="min-w-0 flex-1 flex-row flex-wrap divide-y divide-gray-200">
                            <!--                    <li class="py-3 bg-indigo-500 px-2 ">-->
                            <div class=" p-2 px-3 ">
                                <span class="text-xs bg-blue-900 text-white p-1 font-bold rounded-2xl">
                                   {{ task.department_path[task.department_path.length - 1] }}
                                </span>
                            </div>
                            <!--                    </li>-->
                            <!--                    <li class="py-3 px-2 bg-indigo-400 text-white">-->
                            <div class=" p-2 px-3">
                                <span class="text-xs    ">
                                    {{ task.created }}
                                </span>
                            </div>
                            <!--                    </li>-->
                            <!--                    <li class="px-2 py-3"-->
                            <div class=" p-2 px-3" >
                                <span class=" text-xs rounded-lg font-bold"
                                >
                                    {{ task.assigned_to }}
                                </span>
                            </div>
                            <!--                    </li>-->
                            <!--                    <li class="px-2 py-3 bg-red-400">-->
                            <div class=" bg-red-500  rounded-b-lg p-2 ">
                                <span class="text-md font-bold text-white bg-red-500 rounded-lg">
                                     Atentie : Expira in {{ task.expires_at }} zile
                                </span>
                            </div>
                            <!--                                        <department-breadcrumbs :departments=""/>-->
                            <!--                    </li>-->
                        </div>
                    </div>
                    <!--                </ul>-->
                </div>
            </article>
        </inertia-link>

    </li>
</template>

<script>
export default {
    props: ['task'],
    name: "TaskListItem"
}
</script>

<style scoped>

</style>
