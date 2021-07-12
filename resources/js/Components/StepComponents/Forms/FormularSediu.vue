<template>
  <!-- SEDIU-->
  <disclosure-pane title="Sediu" :default_open="!!default_open">
    <div class="p-4 grid grid-cols-6 gap-6">

      <form-text-input label="Localitate"
                       data_key="agent_economic_sediu_localitate"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_localitate : undefined"
                       @changed="modifiedInput"
      />
      <form-text-input label="Sector/Judet"
                       data_key="agent_economic_sediu_judet"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_judet : undefined"
                       @changed="modifiedInput"
      />
      <form-text-input label="Strada"
                       data_key="agent_economic_sediu_strada"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_strada : undefined"
                       @changed="modifiedInput"
      />
      <form-text-input label="Numar"
                       data_key="agent_economic_sediu_numar"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_numar : undefined"
                       @changed="modifiedInput"
      />
      <form-text-input label="Bloc" data_key="agent_economic_sediu_bloc"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_bloc : undefined"
                       @changed="modifiedInput"/>
      <form-text-input label="Scara" data_key="agent_economic_sediu_scara"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_scara : undefined"
                       @changed="modifiedInput"/>
      <form-text-input label="Etaj" data_key="agent_economic_sediu_etaj"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_etaj : undefined"
                       @changed="modifiedInput"/>
      <form-text-input label="Apartament" data_key="agent_economic_sediu_apartament"
                       :colspans="[6, 2]"
                       :fixed_value="step_data ? step_data.agent_economic_sediu_apartament : undefined"
                       @changed="modifiedInput"/>
    </div>

  </disclosure-pane>
  <!-- END SEDIU -->
</template>

<script>
import DisclosurePane from "../../DisclosurePane";
import FormTextInput from "../FormTextInput";

export default {
  name: "FormularSediu",
  props: ['step_data', 'default_open'],
  components: {
    DisclosurePane,
    FormTextInput
  },
  data() {
    return {}
  },
  methods: {
    modifiedInput(data) {
      this.$emit('changed', data)
    }
  }
}
</script>

<style scoped>

</style>
