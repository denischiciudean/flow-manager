<template>
    <!-- SEDIU-->
    <disclosure-pane title="Sediu">
        <div class="mb-3 pt-0">
            <form-text-input label="Localitate"
                             data_key="agent_economic_sediu_localitate"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_localitate : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Sector/Judet"
                             data_key="agent_economic_sediu_judet"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_judet : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Strada"
                             data_key="agent_economic_sediu_strada"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_strada : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Numar"
                             data_key="agent_economic_sediu_numar"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_numar : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Bloc" data_key="agent_economic_sediu_bloc"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_bloc : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Scara" data_key="agent_economic_sediu_scara"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_scara : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Etaj" data_key="agent_economic_sediu_etaj"
                             :fixed_value="step_data ? step_data.agent_economic_sediu_etaj : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Apartament" data_key="agent_economic_sediu_apartament"
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
    props: ['step_data'],
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
