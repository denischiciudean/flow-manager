<template>

    <div class="flex justify-start">
        <div class="flex align-middle content-center text-xs font-bold text-gray-500"
             v-for="(department, i) in departments" :key="i">
            <div class="flex-grow">{{ department }}</div>
            <div class="align-middle" v-if="i < Object.values(departments).length-1">
                <chevron-right-icon class="mr-1 w-3 text-gray-400"/>
            </div>
        </div>
    </div>

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
