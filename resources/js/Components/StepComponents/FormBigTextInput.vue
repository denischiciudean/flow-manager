<template>
    <div :class="`col-span-${spans[0]} sm:col-span-${spans[1]}`">
        <label for="email_address" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <textarea id="about" name="about" rows="3"
                  v-model="value"
                  :disabled="hasFixedValue"
                  @keyup="valueChanged"
                  class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"/>
    </div>
</template>

<script>
export default {
    name: "FormBigTextInput",
    props: ['label', 'data_key', 'fixed_value', 'colspans'],
    data() {
        return {
            value: '',
            hasFixedValue: false,
            spans: [6, 4]
        }
    },
    created() {
        if (this.colspans) {
            this.spans = this.colspans;
        }
    },
    mounted() {
        if (this.$page.props.done_steps && !this.fixed_value) {
            for (let done_step of this.$page.props.done_steps) {
                if (this.data_key in done_step.data) {
                    this.value = done_step.data[this.data_key]
                }
            }
        }
        if (typeof (this.fixed_value) != 'undefined') {
            this.hasFixedValue = true;
            this.value = this.fixed_value
        }
    },
    methods: {
        valueChanged() {
            this.$emit('changed', [this.data_key, this.value])
        }
    }
}
</script>

<style scoped>

</style>

