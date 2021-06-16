<template>
  <div class="flex flex-row justify-around">
    <div class="mx-4 w-full">
      <label class="inline-flex items-center mt-3">
        <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600"
               v-model="value"
               :disabled="hasFixedValue"
               @change="changedValue">

        <span class="ml-2 text-gray-700">{{ label }}</span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: "CheckBox",
  props: ['label', 'data_key', 'fixed_value'],
  data() {
    return {
      value: '',
      hasFixedValue: false,
    }
  },
  mounted() {
    if (typeof (this.data_key) == 'undefined') {
      this.data_key = this.label.toLowerCase();
    }
    if (typeof (this.fixed_value) != 'undefined') {
      this.hasFixedValue = true;
      this.value = !!this.fixed_value
    }
  },

  methods: {
    changedValue() {
      this.$emit('changed', [this.data_key, this.value]);
    }
  }
}
</script>

<style scoped>

</style>
