<template>
    <!-- SEDIU-->
    <disclosure-pane title="Reprezentata Prin" :default_open="!!default_open">

        <div class="p-4 grid grid-cols-6 gap-6">


            <form-text-input label="Nume"
                             data_key="reprezentant_nume"
                             @changed="modifiedInput"
                             :colspans="[6,2]"
                             :fixed_value="step_data ? step_data.reprezentant_nume : undefined"
            />


            <form-text-input label="Prenume"
                             data_key="reprezentant_prenume"
                             @changed="modifiedInput"
                             :colspans="[6,2]"
                             :fixed_value="step_data ? step_data.reprezentant_prenume : undefined"
            />


            <form-text-input label="In calitate de"
                             data_key="reprezentant_calitate_de"
                             @changed="modifiedInput"
                             :colspans="[6,2]"
                             :fixed_value="step_data ? step_data.reprezentant_calitate_de : undefined"
            />

            <hr class="col-span-6">
            <div class="flex flex-row justify-around col-span-6">
                <div class="w-full">
                    <span class="text-lg font-bold">Domiciliu</span>
                </div>
            </div>

            <form-text-input label="Localitate"
                             data_key="reprezentant_localitate"
                             :colspans="[6,3]"

                             :fixed_value="step_data ? step_data.reprezentant_localitate : undefined"
                             @changed="modifiedInput"
            />


            <form-text-input label="Sector/Judet"
                             data_key="reprezentant_judet"
                             :colspans="[6,3]"

                             :fixed_value="step_data ? step_data.reprezentant_judet : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Strada"
                             data_key="reprezentant_strada"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_strada : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Numar"
                             data_key="reprezentant_numar"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_numar : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Bloc"
                             data_key="reprezentant_bloc"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_bloc : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Scara"
                             data_key="reprezentant_scara"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_scara : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Etaj"
                             data_key="reprezentant_etaj"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_etaj : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Apartament"
                             data_key="reprezentant_apartament"
                             :colspans="[6,2]"

                             :fixed_value="step_data ? step_data.reprezentant_apartament : undefined"
                             @changed="modifiedInput"
            />

            <hr class="col-span-6">
            <div class="flex flex-row justify-around col-span-6">
                <div class="w-full col-span-6">
                    <span class="text-lg font-bold">Act identitate</span>
                </div>
            </div>


            <form-text-input label="Tip"
                             data_key="reprezentant_act_identitate_tip"
                             :colspans="[6, 2]"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_tip : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Seria"
                             data_key="reprezentant_act_identitate_seria"
                             :colspans="[6, 2]"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_seria : undefined"
                             @changed="modifiedInput"/>


            <form-text-input label="Numar"
                             data_key="reprezentant_act_identitate_numar"
                             :colspans="[6, 2]"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_numar : undefined"
                             @changed="modifiedInput"/>

            <form-text-input label="Eliberat de"
                             data_key="reprezentant_act_identitate_eliberat_de"
                             :colspans="[6, 3]"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_eliberat_de : undefined"
                             @changed="modifiedInput"
            />

            <c-date-picker :colspans="[6, 2]"
                           data_key="reprezentant_act_identitate_eliberat_la_data"
                           label="Eliberat la data"
                           @changed="modifiedInput"/>

            <!--            <form-text-input label="Eliberat la data"-->
            <!--                             data_key="reprezentant_act_identitate_eliberat_la_data"-->
            <!--                             :colspans="[6, 3]"-->
            <!--                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_eliberat_la_data : undefined"-->
            <!--                             @changed="modifiedInput"-->
            <!--            />-->


            <form-text-input label="CNP"
                             data_key="reprezentant_act_identitate_cnp"
                             :fixed_value="step_data ? step_data.reprezentant_act_identitate_cnp : undefined"
                             :colspans="[6, 3]"
                             @changed="modifiedInput"
            />
        </div>
    </disclosure-pane>
    <!-- END SEDIU -->
</template>

<script>
import DisclosurePane from "../../DisclosurePane";
import FormTextInput from "../FormTextInput";
import CDatePicker from '@/Components/CDatePicker';

export default {
    name: "FormReprezentant",
    props: ['step_data', 'default_open'],
    components: {
        DisclosurePane,
        FormTextInput,
        CDatePicker
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
