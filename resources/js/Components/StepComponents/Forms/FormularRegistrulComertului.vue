<template>
    <!-- SEDIU-->
    <disclosure-pane title="Date înregistrare Registrul Comerțului">
        <div class="mb-3 pt-0">
            <form-text-input label="Nr. CI"
                             @changed="modifiedInput"
                             data_key="registrul_comertului_nr_ci"
                             :fixed_value="step_data ? step_data.registrul_comertului_nr_ci : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="CUI" data_key="registrul_comertului_cui"
                             :fixed_value="step_data ? step_data.registrul_comertului_cui : undefined"
                             @changed="modifiedInput"/>
        </div>
    </disclosure-pane>
    <!-- END SEDIU -->
</template>

<script>
import DisclosurePane from "../../DisclosurePane";
import FormTextInput from "../FormTextInput";

export default {
    name: "FormularRegistrulComertului",
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
