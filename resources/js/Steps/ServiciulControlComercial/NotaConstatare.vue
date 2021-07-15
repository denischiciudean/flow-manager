<template>

    <div class="">

        <h1 class="text-center my-5 text-2xl">Nota de Constatare</h1>

        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3" v-if="agents_user_list">

            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <user-select
                        label_name="Agent Constatator 1" :options="agents_user_list"

                        data_key="agent_constatator_1"
                        :fixed_value="step_data ? step_data.agent_constatator_1 : undefined"
                        @changed="modifiedInput"/>
                    <user-select label_name="Agent Constatator 2"
                                 :options="agents_user_list"
                                 data_key="agent_constatator_2"
                                 :fixed_value="step_data ? step_data.agent_constatator_2 : undefined"
                                 @changed="modifiedInput"/>
                </div>
            </div>
        </div>

        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <disclosure-pane title="Agent Economic" :default_open="true">
                <div class="p-4 grid grid-cols-6 gap-6">
                    <form-text-input
                        label="Nume"
                        data_key="agent_economic_nume"
                        :max_len="128"
                        :colspans="[6, 3]"
                        :fixed_value="step_data ? step_data.agent_economic_nume : undefined"
                        @changed="modifiedInput"
                    />
                </div>

                <!-- SEDIU-->
                <formular-sediu @changed="modifiedInput" :step_data="step_data" class="mb-3"/>
                <!-- END SEDIU -->
                <formular-registrul-comertului @changed="modifiedInput" :step_data="step_data" class="mb-3"/>
                <!-- END REG COMERTULUI -->
                <!-- Date Reprezentat-->
                <form-reprezentant @changed="modifiedInput" :step_data="step_data" class="mb-3"/>
                <!-- END Date Reprezentat-->
            </disclosure-pane>
        </div>

        <!--   DATE CONSTATARE     -->
        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <disclosure-pane title="Date Constatare" :default_open="true">
                <div class="p-4 grid grid-cols-6 gap-6">
                    <form-text-input label="Seria"
                                     :colspans="[6, 1]"
                                     data_key="constatare_seria"
                                     :fixed_value="department ? department.doc_series : (step_data ? step_data.constatare_seria : undefined)"
                                     @changed="modifiedInput"
                    />
                    <form-text-input label="Numar"
                                     data_key="constatare_nr"
                                     :colspans="[6, 1]"

                                     :fixed_value="step_data ? step_data.constatare_nr : undefined"
                                     @changed="modifiedInput"
                    />

                    <c-date-picker :colspans="[6, 2]"
                                   data_key="constatare_data"
                                   label="Data"
                                   @changed="modifiedInput"/>

                    <form-text-input label="Unitatea situată la adresa"
                                     :max_len="256"
                                     :colspans="[6, 2]"
                                     data_key="constatare_unitate_adresa"
                                     :fixed_value="step_data ? step_data.constatare_unitate_adresa : undefined"
                                     @changed="modifiedInput"
                    />
                    <form-text-input label="Cu profil"
                                     data_key="constatare_unitate_profil"
                                     :colspans="[6, 2]"
                                     :fixed_value="step_data ? step_data.constatare_unitate_profil : undefined"
                                     @changed="modifiedInput"
                    />
                    <form-text-input label="În prezența"
                                     :max_len="128"
                                     :colspans="[6, 2]"
                                     data_key="constatare_in_prezenta"
                                     :fixed_value="step_data ? step_data.constatare_in_prezenta : undefined"
                                     @changed="modifiedInput"
                    />
                    <form-text-input label="În calitate de"
                                     :max_len="128"
                                     :colspans="[6, 2]"
                                     :fixed_value="step_data ? step_data.constatare_in_calitate_de : undefined"
                                     data_key="constatare_in_calitate_de"
                                     @changed="modifiedInput"
                    />
                    <form-big-text-input label="Constatari" data_key="constatare_text"
                                         @changed="modifiedInput"/>
                </div>
            </disclosure-pane>
        </div>
        <!--    END DATE CONSTATARE    -->

        <!-- DOCUMENTE PREZENTATE-->
        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <disclosure-pane title="Au fost prezente la control următoarele documente" :default_open="true">
                <div class="mb-3 pt-0">
                    <check-box label="Autorizație de funcționare" data_key="prezentare_autorizatie_functionare"
                               :fixed_value="step_data ? step_data.prezentare_autorizatie_functionare : undefined"
                               @changed="modifiedInput"/>
                    <check-box label="Carte de Identitate (CI)" data_key="prezentare_ci" @changed="modifiedInput"
                               :fixed_value="step_data ? step_data.prezentare_ci : undefined"
                    />
                    <check-box label="CUI" data_key="prezentare_cui" @changed="modifiedInput"
                               :fixed_value="step_data ? step_data.prezentare_cui : undefined"
                    />
                    <check-box label="Autorizație de sanatate" data_key="prezentare_autorizatie_sanatate"
                               :fixed_value="step_data ? step_data.prezentare_autorizatie_sanatate : undefined"
                               @changed="modifiedInput"/>
                </div>
            </disclosure-pane>
        </div>
        <!-- END DOCUMENTE PREZENTATE-->

        <!-- MENTIUNI -->
        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <disclosure-pane :title="'Mentiuni'" :default_open="true">
                <div class="p-4 grid grid-cols-6 gap-6">
                    <form-big-text-input
                        label="Mentiuni"
                        data_key="mentiuni"
                        :colspans="[6, 3]"
                        @changed="modifiedInput"
                    />
                    <form-big-text-input
                        label="Masuri"
                        data_key="masuri"
                        :colspans="[6, 3]"
                        @changed="modifiedInput"
                    />
                </div>
            </disclosure-pane>
        </div>
        <!-- MENTIUNI -->

        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <RadioGroup v-model="form.emis_proces_verbal" :disabled="is_display">
                <RadioGroupLabel>
                    <div class="mb-3 pt-0">
                        <div class="flex flex-row justify-around">
                            <div class="mx-4 w-full">
                                <span class="text-lg font-bold">Emis Proces Verbal</span>
                            </div>
                        </div>
                    </div>
                </RadioGroupLabel>
                <div class="flex justify-around">
                    <RadioGroupOption v-slot="{ checked }" :value="true">
                        <div class="px-3 cursor-pointer py-2 rounded shadow outline-none"
                             :class="checked ? 'bg-indigo-400 text-white font-bold' : ''">Da
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption v-slot="{ checked }" :value="false">
                        <div class="px-3 py-2 cursor-pointer rounded shadow outline-none"
                             :class="checked ? 'bg-indigo-400 text-white font-bold' : ''">Nu
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>

        <!-- PREZENTARE SEDIU -->
        <div class="shadow  sm:rounded-md rounded bg-white p-4 mt-3">
            <disclosure-pane title="Prezentare la sediu">
                <div class="p-4 grid grid-cols-6 gap-6">
                    <c-date-picker :colspans="[6, 3]"
                                   data_key="prezentare_sediu_data"
                                   label="Data"
                                   @changed="modifiedInput"/>
<!--                    <form-text-input label="Ora" data_key="prezentare_sediu_ora" @changed="modifiedInput"/>-->
                </div>
            </disclosure-pane>
        </div>
        <!-- END Prezentare Sediu -->

        <!-- FILE UPLOAD-->
        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane title="Incarca Document" :unmount="false">
                <file-upload @changed="modifiedInput" data_key="uploaded_doc"
                             :as_display="true"
                             :multiple="true"
                             :fixed_value="step_data ? step_data.uploaded_doc : undefined"
                             :step="step"
                >
                </file-upload>
            </disclosure-pane>
        </div>
        <!-- FILE UPLOAD -->
        <div class="rounded bg-white p-4 mt-4 text-center" v-if="!is_display">
            <button @click="submit" class="py-3 px-2 rounded bg-purple-500 text-white font-bold">Creaza</button>
        </div>
    </div>
</template>

<script>
import {Disclosure, DisclosurePanel, DisclosureButton} from '@headlessui/vue'
import {ChevronUpIcon} from "@heroicons/vue/outline/esm";
import DisclosurePane from "../../Components/DisclosurePane";
import UserSelect from "../../Components/StepComponents/UserSelect";
import FormTextInput from "../../Components/StepComponents/FormTextInput";
import FormBigTextInput from "../../Components/StepComponents/FormBigTextInput";
import CheckBox from "../../Components/StepComponents/CheckBox";

import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
} from '@headlessui/vue'

import FormularSediu from "../../Components/StepComponents/Forms/FormularSediu";
import FormularRegistrulComertului from "../../Components/StepComponents/Forms/FormularRegistrulComertului";
import FormReprezentant from "../../Components/StepComponents/Forms/FormReprezentant";
import FileUpload from "../../Components/StepComponents/FileUpload";
import CDatePicker from "../../Components/CDatePicker";

export default {
    name: "NotaConstatare",
    components: {
        CDatePicker,
        FileUpload,
        FormReprezentant,
        FormularRegistrulComertului,
        CheckBox,
        FormTextInput,
        FormBigTextInput,
        UserSelect,
        Disclosure,
        DisclosurePanel,
        DisclosurePane,
        DisclosureButton,
        ChevronUpIcon,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        FormularSediu
    },
    props: [
        'department',
        'workflow_id',
        'workflow_slug',
        'step',
        'step_data',
        'is_display'
    ],
    data() {
        return {
            agents: [{text: '1', value: 1}, {text: '2', value: 2}],
            open: true,
            form: {
                emis_proces_verbal: false,
                uploaded_doc: null
            },
            agents_user_list: null
        }
    },
    mounted() {
        this.retrieveUsers();
        console.log(this.$page.props)
        if (this.step_data) {
            this.form.emis_proces_verbal = !!this.step_data.emis_proces_verbal
        }
    },
    methods: {
        modifiedInput(data) {
            this.form[data[0]] = data[1]
        },

        submit() {
            this.$inertia.post(`/nota-noua/post/creaza/${this.workflow_id}/${this.workflow_slug}`, this.form)
        },

        async retrieveUsers() {
            const res = await axios.get(`/api/mentionable-users?workflow_id=${this.workflow_id}`);
            this.agents_user_list = res.data.data;
        }
    }
}
</script>

<style scoped>

</style>
