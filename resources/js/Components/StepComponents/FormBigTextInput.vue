<template>
    <div class="flex flex-row justify-around">
        <div class="mx-4 w-1/5">
            <span class="text-sm">{{ label }}</span>
        </div>
        <div class="flex-grow w-4/5">
            <textarea id="about" name="about" rows="3"
                      v-model="value"
                      :disabled="hasFixedValue"
                      @keyup="valueChanged"
                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormBigTextInput",
    props: ['label', 'data_key', 'fixed_value'],
    data() {
        return {
            value: '',
            hasFixedValue: false
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

