<template>
    <div :class="`col-span-${spans[0]} sm:col-span-${spans[1]}`">
        <label for="email_address" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <DatePicker
            color="indigo"
            mode="dateTime"
            :is24hr="true"
            v-model="date"
            :model-config="{
                type: 'dateTime',
                }">
            <template #default="{ inputValue, inputEvents }">
                <input style="height:38px; padding-left:10px;padding-right: 10px; border: solid rgb(215,215,215) 1px"
                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 h-full rounded-md"
                       :value="inputValue" v-on="inputEvents"/>
            </template>
        </DatePicker>
    </div>
</template>

<script>

import {DatePicker} from 'v-calendar';

export default {
    name: "CDatePicker",
    components: {DatePicker},
    props: ['colspans', 'label', 'data_key'],
    data() {
        return {
            spans: [6, 3],
            date: new Date()
        }
    },
    created() {
        this.spans = this.colspans ? this.colspans : this.spans;
    },
    watch: {
        date() {
            this.$emit('changed', [this.data_key, this.date.getTime()]);
        }
    },
}
</script>

<style scoped>

</style>
