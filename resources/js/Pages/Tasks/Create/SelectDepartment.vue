<template>
    <create-task :current_step="step">
        <div class="flex flex-row justify-between flex-wrap  align-middle pt-10">
            <div v-for="department in departments" :key="department.id" class="w-1/3 px-3 py-2"
                 style="max-width: 228px">
                <inertia-link  :href="`/nota-noua/${department.id}/${department.slug}/tip-nota`">
                    <div class="bg-gray-300 h-full px-3 py-5 text-center items-center">
                        {{ department.name }}
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
    props: ['step', 'departments'],
    components: {CreateTask}
}
</script>

<style scoped>

</style>
