<template>

    <main-layout>
        <template #left-sidebar>
            <left-sidebar></left-sidebar>
        </template>

        <template #right-sidebar>
            <task-history-right-sidebar :task="task" :workflow="workflow"
                                        :assigned_to="!!current_step ? current_step.assigned_to : null"/>
        </template>

        <div v-for="(completed_step, i) in done_steps">
            <component :is="`Details${completed_step.component}`"
                       :department="task"
                       class="mt-3"
                       :workflow_id="workflow.id"
                       :workflow_slug="workflow.slug"
                       :step="completed_step"
                       :step_data="completed_step.data"
                       :is_display="true"
            ></component>
        </div>

        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3" v-if="current_step">
            <disclosure-pane :title="`Current - ${current_step.component}`" :default_open="true">
                <component
                    :is="current_step.component"
                    :step="current_step"
                >
                </component>
            </disclosure-pane>
        </div>

        <div class="rounded bg-white p-4 mt-5" v-if="current_step || comments.length">
            <disclosure-pane :title="`Comments`" :default_open="true">
                <comments-section :mentionable_users="mentionable_users" :comments="comments"/>
            </disclosure-pane>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from "../../Layouts/MainLayout";
import LeftSidebar from "../../Layouts/_partials/LeftSidebar";
import TaskHistoryRightSidebar from "./Partials/TaskHistoryRightSidebar";
import {PlusIcon} from '@heroicons/vue/outline/'
import DisclosurePane from "../../Components/DisclosurePane";
import * as all_steps from '@/Steps'
import CommentsSection from "../../Components/CommentsSection";

export default {
    name: "ViewTask",
    props: ['task', 'workflow', 'done_steps', 'current_step', 'comments'],
    components: {
        CommentsSection,
        TaskHistoryRightSidebar, LeftSidebar, MainLayout, PlusIcon,
        DisclosurePane,
        ...all_steps
    },
    data() {
        return {
            completed_steps: [],
            mentionable_users: []
        }
    },
    methods: {
        async retrieveMentionableUsers() {
            const res = await axios.get(`/api/mentionable-users?workflow_id=${this.$page.props.workflow.id}`);
            this.mentionable_users = res.data.data;
        }
    },
    mounted() {
        this.retrieveMentionableUsers();
    }
}
</script>

<style scoped>

</style>
