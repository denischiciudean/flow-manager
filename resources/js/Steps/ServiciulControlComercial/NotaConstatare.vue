<template>

    <div class="">

        <h1 class="text-center my-5 text-2xl">Nota de Constatare</h1>

        <div class=" rounded bg-white p-4">
            <div class="mb-3 pt-0">
                <user-select label_name="Agent Constatator 1" :options="agents"

                             :fixed_value="step_data ? step_data.title : undefined"
                             :classes="[['w-1/5'], ['w-4/5']]"/>
            </div>

            <div class="mb-3 pt-0">
                <user-select label_name="Agent Constatator 2" :options="agents" :classes="[['w-1/5'], ['w-4/5']]"/>
            </div>
        </div>

        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane title="Agent Economic" :default_open="true">
                <div class="mb-3 pt-2">
                    <form-text-input
                        label="Nume"
                        data_key="agent_economic_nume"
                        :max_len="128"
                        :fixed_value="step_data ? step_data.agent_economic_nume : undefined"
                        @changed="modifiedInput"
                    />
                </div>

                <!-- SEDIU-->
                <formular-sediu @changed="modifiedInput" :step_data="step_data"/>
                <!-- END SEDIU -->
                <formular-registrul-comertului @changed="modifiedInput" :step_data="step_data"/>
                <!-- END REG COMERTULUI -->
                <!-- Date Reprezentat-->
                <form-reprezentant @changed="modifiedInput" :step_data="step_data"/>
                <!-- END Date Reprezentat-->
            </disclosure-pane>
        </div>

        <!--   DATE CONSTATARE     -->
        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane title="Date Constatare">
                <div class="mb-3 pt-0">
                    <form-text-input label="Seria"
                                     data_key="constatare_seria"
                                     :fixed_value="department ? department.doc_series : (step_data ? step_data.constatare_seria : undefined)"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Numar"
                                     data_key="constatare_nr"
                                     :fixed_value="step_data ? step_data.constatare_nr : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Data"
                                     data_key="constatare_data"
                                     :fixed_value="step_data ? step_data.constatare_data : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Ora"
                                     data_key="constatare_ora"
                                     :fixed_value="step_data ? step_data.constatare_ora : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Unitatea situată la adresa"
                                     :max_len="256"
                                     data_key="constatare_unitate_adresa"
                                     :fixed_value="step_data ? step_data.constatare_unitate_adresa : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Cu profil"
                                     data_key="constatare_unitate_profil"
                                     :fixed_value="step_data ? step_data.constatare_unitate_profil : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="În prezența"
                                     :max_len="128"
                                     data_key="constatare_in_prezenta"
                                     :fixed_value="step_data ? step_data.constatare_in_prezenta : undefined"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="În calitate de"
                                     :max_len="128"
                                     :fixed_value="step_data ? step_data.constatare_in_calitate_de : undefined"
                                     data_key="constatare_in_calitate_de"
                                     @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-big-text-input label="Constatari" data_key="constatare_text"
                                         @changed="modifiedInput"/>
                </div>
            </disclosure-pane>
        </div>
        <!--    END DATE CONSTATARE    -->

        <!-- DOCUMENTE PREZENTATE-->
        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane title="Au fost prezente la control următoarele documente" default_open="true">
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
        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane :title="'Mentiuni'" :default_open="true">
                <div class="mb-3 pt-0">
                    <form-big-text-input
                        label="Mentiuni"
                        data_key="mentiuni"
                        @changed="modifiedInput"
                    />
                </div>

                <div class="mb-3 pt-0">
                    <form-big-text-input
                        label="Masuri"
                        data_key="masuri"
                        @changed="modifiedInput"
                    />
                </div>
            </disclosure-pane>
        </div>
        <!-- MENTIUNI -->

        <div class="rounded bg-white p-4 mt-4">
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
                        <div class="px-3 py-2 rounded shadow outline-none"
                             :class="checked ? 'bg-blue-400 text-white font-bold' : ''">Da
                        </div>
                    </RadioGroupOption>
                    <RadioGroupOption v-slot="{ checked }" :value="false">
                        <div class="px-3 py-2 rounded shadow outline-none"
                             :class="checked ? 'bg-blue-400 text-white font-bold' : ''">Nu
                        </div>
                    </RadioGroupOption>
                </div>
            </RadioGroup>
        </div>

        <!-- PREZENTARE SEDIU -->
        <div class="rounded bg-white p-4 mt-4">
            <disclosure-pane title="Prezentare la sediu">
                <div class="mb-3 pt-0">
                    <form-text-input label="Data" data_key="prezentare_sediu_data"/>
                </div>

                <div class="mb-3 pt-0">
                    <form-text-input label="Ora" data_key="prezentare_sediu_ora"/>
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

export default {
    name: "NotaConstatare",
    components: {
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
        }
    },
    mounted() {
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
        }
    }
}
</script>

<style scoped>

</style>
