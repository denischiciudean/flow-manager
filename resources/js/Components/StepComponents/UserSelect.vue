<template>
    <div class="flex flex-row justify-around">
        <div class="mx-4" :class="[...(classes[0])]">
            <span class="text-sm">{{ label_name }}</span>
        </div>
        <div class="flex-grow " :class="[...(classes[1])]">
            <input type="text" placeholder="Placeholder"
                   class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>
        </div>
    </div>
</template>

<script>

export default {

    name: "UserSelect",
    props: ['label_name', 'classes', 'users'],
    data() {
        return {
            selected: 1
        }
    },
    methods: {}
}
</script>

<style scoped>

</style>
