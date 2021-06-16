<template>
    <create-task :current_step="3" :selected_department="selected_department">
        <component :is="step_component"
                   :workflow_id="workflow_id" :workflow_slug="workflow_slug" :step="step"
                   :department="selected_department"></component>
    </create-task>
</template>

<script>
import CreateTask from "@/Pages/Tasks/Partials/CreateTask";
import * as all_steps from "@/Steps";


export default {
    name: "FillTaskFirstStep",
    components: {
        CreateTask,
        ...all_steps
    },
    props: [
        'step',
        'selected_department',
        'workflow_id',
        'workflow_slug'
    ],
    data() {
        return {
            step_component: 'NotaConstatare'
        }
    },
    methods: {}
}

</script>

<style scoped>

</style>
