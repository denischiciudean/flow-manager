<template>
    <main-layout>
        <template #left-sidebar>
            <left-sidebar/>
        </template>

        <div class="text-2xl">
            Adaugare nota de lucru noua
        </div>

        <div class="mt-3">
            <div class="flex w-full">
                <div class="w/1-3 flex-grow">
                    <div class="text-center">
                        <inertia-link :href="`/nota-noua/departament`">Selectare Departament</inertia-link>
                    </div>
                    <div class="h-6 w-full rounded-l"
                         :class="[current_step >= 1 ? 'bg-yellow-500' : 'bg-gray-300']"></div>
                </div>

                <div class="w/1-3 flex-grow">
                    <div class="text-center">
                        <inertia-link v-if="selected_department"
                                      :href="`/nota-noua/${selected_department.id}/${selected_department.slug}/tip-nota`">
                            Selectare Tip
                            Document
                        </inertia-link>
                        <div v-else>Selectare Tip Document</div>
                    </div>
                    <div class="h-6 w-full"
                         :class="[current_step >= 2 ? 'bg-yellow-500' : 'bg-gray-300']"></div>
                </div>

                <div class="w/1-3 flex-grow">
                    <div class="text-center">
                        Introducere Date
                    </div>
                    <div class="h-6 w-full rounded-r"
                         :class="[current_step >= 3 ? 'bg-yellow-500' : 'bg-gray-300']"></div>
                </div>
            </div>
        </div>

        <slot/>

    </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";
import LeftSidebar from "@/Layouts/_partials/LeftSidebar";

export default {
    name: "CreateTask",
    components: {LeftSidebar, MainLayout},
    props: ['current_step', 'selected_department'],

}
</script>

<style scoped>

</style>
