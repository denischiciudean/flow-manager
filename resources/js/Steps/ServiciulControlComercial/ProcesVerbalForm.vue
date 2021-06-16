<template>
    <div class="">
        <h1 class="text-center my-5 text-2xl">Intocmire Proces Verbal</h1>
    </div>

    <!-- Formular -->
    <disclosure-pane title="Formular">
        <div class="mb-3 pt-0">
            <form-text-input label="Seria"
                             data_key="serie_proces_verbal"
                             :fixed_value="step_data ? step_data.serie_proces_verbal : undefined"


                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Numar"
                             data_key="numar_proces_verbal"
                             :fixed_value="step_data ? step_data.numar_proces_verbal : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Ziua"
                             data_key="ziua_proces_verbal"
                             :fixed_value="step_data ? step_data.ziua_proces_verbal : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Luna"
                             data_key="luna_proces_verbal"
                             :fixed_value="step_data ? step_data.luna_proces_verbal : undefined"
                             @changed="modifiedInput"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Anul" data_key="an_proces_verbal"
                             :fixed_value="step_data ? step_data.an_proces_verbal : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Nume Agent" data_key="nume_agent_proces_verbal"
                             :fixed_value="step_data ? step_data.nume_agent_proces_verbal : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Nume Serviciu" data_key="nume_serviciu_proces_verbal"
                             :fixed_value="step_data ? step_data.nume_serviciu_proces_verbal : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Nr. Legitimatie" data_key="nr_legitimatie_agent_proces_verbal"
                             :fixed_value="step_data ? step_data.nr_legitimatie_agent_proces_verbal : undefined"
                             @changed="modifiedInput"/>
        </div>

        <div class="mb-3 pt-0">
            <form-big-text-input label="Am constatat ca" data_key="proces_verbal_constatare"
                                 :fixed_value="step_data ? step_data.proces_verbal_constatare : undefined"
                                 @changed="modifiedInput"/>
        </div>
    </disclosure-pane>
    <!-- END SEDIU -->

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

    <!-- Date Reprezentat-->
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
    <!-- END Date Reprezentat-->

    <hr>

    <disclosure-pane title="A savarsit in">
        <div class="mb-3 pt-0">
            <form-text-input label="Ziua"
                             @changed="modifiedInput"
                             data_key="proces_verbal_fapta_ziua"
                             :fixed_value="step_data ? step_data.proces_verbal_fapta_ziua : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Ora"
                             @changed="modifiedInput"
                             data_key="proces_verbal_fapta_ora"
                             :fixed_value="step_data ? step_data.proces_verbal_fapta_ora : undefined"
            />
        </div>

        <div class="mb-3 pt-0">
            <form-text-input label="Locul"
                             @changed="modifiedInput"
                             data_key="proces_verbal_fapta_locul"
                             :fixed_value="step_data ? step_data.proces_verbal_fapta_locul : undefined"
            />
        </div>

        <div class="px-3 mb-4 mt-1 text-2xl font-bold">
            Fapte savarsite
        </div>

        <amenzi :data_key="`amenzi`"
                :fixed_value="step_data ? step_data.amenzi : undefined"
                @changed="modifiedInput"/>

        <div class="px-3 mb-4 mt-1 my-3" v-if="!is_display">
            <button @click="complete" class="py-1 px-2 bg-green-500 text-white">Done</button>
        </div>

    </disclosure-pane>


</template>

<script>

import DisclosurePane from "../../Components/DisclosurePane";

import FormTextInput from "../../Components/StepComponents/FormTextInput";
import FormBigTextInput from "../../Components/StepComponents/FormBigTextInput";
import Amenzi from "../../Components/StepComponents/Amenzi";

export default {
    name: "ProcesVerbalForm",
    components: {
        DisclosurePane,
        //
        FormTextInput,
        FormBigTextInput,
        Amenzi
    },
    props: [
        'department',
        'workflow_id',
        'workflow_slug',
        'step',
        'step_data',
        'is_display',
    ],
    data() {
        return {
            form: {}
        }
    },
    methods: {
        modifiedInput(data) {
            this.form[data[0]] = data[1]
        },
        complete() {
            this.$inertia.post('/note/finish-step', {
                step_id: this.step.id,
                data: this.form
            });
        }
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
