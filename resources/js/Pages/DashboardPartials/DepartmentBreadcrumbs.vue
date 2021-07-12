<template>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1">
            <li v-for="(department, i) in departments" :key="department" class="flex-shrink">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor"
                         viewBox="0 0 20 20"
                         aria-hidden="true"
                         v-if="i != 0">
                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z"/>
                    </svg>
                    <!--                    <ChevronRightIcon class="flex-shrink-1 h-5 text-gray-400" aria-hidden="true" />-->
                    <a href="#"
                       class="text-xs hover:cursor-default cursor-default  font-medium text-gray-500 hover:text-gray-700">{{
                        department }}</a>
                </div>
            </li>
        </ol>
    </nav>
    <!--    <div class="flex justify-start">-->
    <!--        <div class="flex align-middle content-center text-xs font-bold text-gray-500"-->
    <!--             v-for="(department, i) in departments" :key="i">-->
    <!--            <div class="flex-grow">{{ department }}</div>-->
    <!--            <div class="align-middle" v-if="i < Object.values(departments).length-1">-->
    <!--                <chevron-right-icon class="mr-1 w-3 text-gray-400"/>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

</template>

<script>
import {
    ChevronRightIcon
} from "@heroicons/vue/outline/esm";

export default {
    components: {ChevronRightIcon},
    name: "DepartmentBreadcrumbs",
    props: ['departments']
}
</script>

<style scoped>

</style>
