<template>
    <create-task :current_step="step" :department="department">
        <div class="flex flex-row justify-between flex-wrap  align-middle pt-10">
            <div v-for="workflow in workflows" :key="workflow.id" class="w-1/3 px-3 py-2"
                 style="max-width: 228px">
                <inertia-link method="get" type="button"
                              :href="`/nota-noua/creaza/${workflow.id}/${workflow.slug}`">
                    <div class="bg-gray-300 h-full px-3 py-5 text-center items-center">
                        {{ workflow.name }}
                    </div>
                </inertia-link>
            </div>
        </div>
    </create-task>
</template>

<script>
import CreateTask from "@/Pages/Tasks/Partials/CreateTask";

export default {
    name: "SelectDepartment",
    props: ['step', 'workflows', 'department'],
    components: {CreateTask}
}
</script>

<style scoped>

</style>
