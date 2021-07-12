<template>
    <div :class="`col-span-${spans[0]} sm:col-span-${spans[1]}`">
        <label for="email_address" class="block text-sm font-medium text-gray-700">{{ label }}</label>
        <input
            v-model="value"
            :disabled="hasFixedValue"
            @keyup="changedValue"
            type="text"

            :name="data_key"
            :id="data_key"
            autocomplete="off"
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
    <!--    <div class="flex flex-row justify-around">-->
    <!--        <div class="mx-4 w-1/5">-->
    <!--            <span class="text-sm">{{ label }}</span>-->
    <!--        </div>-->
    <!--        <div class="flex-grow w-4/5">-->
    <!--            <input type="text"-->
    <!--                   :placeholder="placeholder"-->
    <!--                   v-model="value"-->
    <!--                   :disabled="hasFixedValue"-->
    <!--                   @keyup="changedValue"-->
    <!--                   :class="[!valid ? 'border-2 border-red-300 focus:border-red-300 focus:outline-none appearance-none' : 'border-0 focus:outline-none focus:ring shadow outline-none']"-->
    <!--                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>-->
    <!--        </div>-->
    <!--    </div>-->
</template>

<script>
export default {
    name: "FormTextInput",
    props: ['label', 'max_len', 'data_key', 'fixed_value', 'prefilled', 'colspans'],
    data() {
        return {
            value: '',
            hasFixedValue: false,
            placeholder: '',
            spans: [6, 3]
        }
    },
    created() {
        if (this.colspans) {
            this.spans = this.colspans;
        }
    },
    watch: {
        value() {
            this.$emit('changed', [this.data_key, this.value]);
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

        if (this.prefilled) {
            this.value = this.prefilled
        }
        this.placeholder = this.label
        if (typeof (this.data_key) == 'undefined') {
            this.data_key = this.label.toLowerCase();
        }
        if (typeof (this.fixed_value) != 'undefined') {
            this.hasFixedValue = true;
            this.value = this.fixed_value
        }
    },
    computed: {
        valid() {
            if (this.$page.props.errors[this.data_key]) {
                this.placeholder = this.$page.props.errors[this.data_key];
                return false
            }
            if (this.value == null) {
                return true;
            }
            return typeof (this.max_len) != 'undefined' ? this.value.length <= this.max_len : true
        }
    },
    methods: {
        changedValue() {
            if (this.valid) {
                this.$emit('changed', [this.data_key, this.value]);
            }
        }
    }
}
</script>

<style scoped>

</style>
