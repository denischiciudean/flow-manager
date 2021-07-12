<template>
    <!-- SEDIU-->
    <disclosure-pane title="Date înregistrare Registrul Comerțului" :default_open="!!default_open">
        <div class="p-4 grid grid-cols-6 gap-6">
            <form-text-input label="Nr. CI"
                             :colspans="[6, 3]"
                             @changed="modifiedInput"
                             data_key="registrul_comertului_nr_ci"
                             :fixed_value="step_data ? step_data.registrul_comertului_nr_ci : undefined"
            />
            <form-text-input label="CUI" data_key="registrul_comertului_cui"
                             :colspans="[6, 3]"
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
