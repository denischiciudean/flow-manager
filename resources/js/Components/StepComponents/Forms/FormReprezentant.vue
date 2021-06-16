<template>
    <!-- SEDIU-->
    <disclosure-pane title="Reprezentata Prin">

        <div class="mb-3 pt-0">
            <form-text-input label="Nume"
                             data_key="reprezentant_nume"
                             @changed="modifiedInput"
                             :fixed_value="step_data ? step_data.reprezentant_nume : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Prenume"
                             data_key="reprezentant_prenume"
                             @changed="modifiedInput"
                             :fixed_value="step_data ? step_data.reprezentant_prenume : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="In calitate de"
                             data_key="reprezentant_calitate_de"
                             @changed="modifiedInput"
                             :fixed_value="step_data ? step_data.reprezentant_calitate_de : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <div class="flex flex-row justify-around">
                <div class="mx-4 w-full">
                    <span class="text-lg font-bold">Domiciliu</span>
                </div>
            </div>
        </div>
        <div class="mb-3 pt-0">
            <form-text-input label="Localitate"
                             data_key="reprezentant_localitate"
                             :fixed_value="step_data ? step_data.reprezentant_localitate : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Sector/Judet"
                             data_key="reprezentant_judet"
                             :fixed_value="step_data ? step_data.reprezentant_judet : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Strada"
                             data_key="reprezentant_strada"
                             :fixed_value="step_data ? step_data.reprezentant_strada : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Numar"
                             data_key="reprezentant_numar"
                             :fixed_value="step_data ? step_data.reprezentant_numar : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Bloc"
                             data_key="reprezentant_bloc"
                             :fixed_value="step_data ? step_data.reprezentant_bloc : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Scara"
                             data_key="reprezentant_scara"
                             :fixed_value="step_data ? step_data.reprezentant_scara : undefined"
                             @changed="modifiedInput"/>
        </div>


        <div class="mb-3 pt-0">
            <form-text-input label="Etaj"
                             data_key="reprezentant_etaj"
                             :fixed_value="step_data ? step_data.reprezentant_etaj : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Apartament"
                             data_key="reprezentant_apartament"
                             :fixed_value="step_data ? step_data.reprezentant_apartament : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <div class="flex flex-row justify-around">
                <div class="mx-4 w-full">
                    <span class="text-lg font-bold">Act identitate</span>
                </div>
            </div>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Tip"
                             data_key="reprezentant_act_identitate_tip"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_tip : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Seria"
                             data_key="reprezentant_act_identitate_seria"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_seria : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Numar"
                             data_key="reprezentant_act_identitate_numar"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_numar : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Eliberat de"

                             data_key="reprezentant_act_identitate_eliberat_de"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_eliberat_de : undefined"
                             @changed="modifiedInput"
            />
        </div>


        <div class="mb-3 pt-0">
            <form-text-input label="Eliberat la data"
                             data_key="reprezentant_act_identitate_eliberat_la_data"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_eliberat_la_data : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="CNP"
                             data_key="reprezentant_act_identitate_cnp"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_cnp : undefined"
                             @changed="modifiedInput"
            />
        </div>
    </disclosure-pane>
    <!-- END SEDIU -->
</template>

<script>
import DisclosurePane from "../../DisclosurePane";
import FormTextInput from "../FormTextInput";

export default {
    name: "FormReprezentant",
    props: ['step_data'],
    components: {
        DisclosurePane,
        FormTextInput
    },
    data() {
        return {

        }
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
