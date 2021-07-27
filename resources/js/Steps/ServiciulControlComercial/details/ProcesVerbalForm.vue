<template>
    <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Description list-->
        <disclosure :defaultOpen="true">
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <DisclosureButton class="w-full">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 id="applicant-information-title"
                                class="text-lg leading-6 text-left font-medium text-gray-900">
                                Proces Verbal
                            </h2>
                            <!--                    <p class="mt-1 max-w-2xl text-sm text-gray-500">-->
                            <!--                        Personal details and application.-->
                            <!--                    </p>-->
                        </div>
                    </DisclosureButton>
                    <DisclosurePanel>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 md:grid-cols-3">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Seria
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.serie_proces_verbal }}{{ step_data.numar_proces_verbal }}
                                        <!--                                {{ step_data.agent_constatator_1 }}-->
                                    </dd>
                                </div>

                                <hr class="col-span-full">
                                <!-- AGENT ECONOMIC-->
                                <div class="sm:col-span-1 font-bold">
                                    <dt class="text-sm  text-gray-500">
                                        Data
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.ziua_proces_verbal }}.{{
                                            step_data.luna_proces_verbal
                                        }}.{{ step_data.an_proces_verbal }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 font-bold">
                                        Agent
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <!--                                        {{ agent_economic }}-->
                                        <!--                                        {{-->
                                        <!--                                            `Loc. ${-->
                                        <!--                                                step_data.agent_economic_sediu_localitate-->
                                        <!--                                            }, Jud. ${-->
                                        <!--                                                step_data.agent_economic_sediu_judet-->
                                        <!--                                            }, Str. ${-->
                                        <!--                                                step_data.agent_economic_sediu_strada-->
                                        <!--                                            }, Nr. ${-->
                                        <!--                                                step_data.agent_economic_sediu_numar-->
                                        <!--                                            }, Bloc ${-->
                                        <!--                                                step_data.agent_economic_sediu_bloc ?? '-'-->
                                        <!--                                            }, Scara ${-->
                                        <!--                                                step_data.agent_economic_sediu_scara ?? '-'-->
                                        <!--                                            }, Etaj ${-->
                                        <!--                                                step_data.agent_economic_sediu_etaj ?? '-'-->
                                        <!--                                            }, Ap. ${-->
                                        <!--                                                step_data.agent_economic_sediu_apartament ?? '-'-->
                                        <!--                                            }`-->
                                        <!--                                        }}-->
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Serviciu
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.nume_serviciu_proces_verbal }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Legitimat prin
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.nr_legitimatie_agent_proces_verbal }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Constatare
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.proces_verbal_constatare }}
                                    </dd>
                                </div>

                                <hr class="col-span-full">


                                <div class="sm:col-span-1 font-bold">
                                    <dt class="text-sm  text-gray-500">
                                        Agent economic
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ agent_economic }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 font-bold">
                                        Adresa
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{
                                            `Loc. ${
                                                step_data.agent_economic_sediu_localitate
                                            }, Jud. ${
                                                step_data.agent_economic_sediu_judet
                                            }, Str. ${
                                                step_data.agent_economic_sediu_strada
                                            }, Nr. ${
                                                step_data.agent_economic_sediu_numar
                                            }, Bloc ${
                                                step_data.agent_economic_sediu_bloc ?? '-'
                                            }, Scara ${
                                                step_data.agent_economic_sediu_scara ?? '-'
                                            }, Etaj ${
                                                step_data.agent_economic_sediu_etaj ?? '-'
                                            }, Ap. ${
                                                step_data.agent_economic_sediu_apartament ?? '-'
                                            }`
                                        }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Date înregistrare Registrul Comerțului
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        Nr. CI : {{ step_data.registrul_comertului_nr_ci }}
                                        <br>
                                        CUI : {{ step_data.registrul_comertului_cui }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Reprezentat de
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.reprezentant_nume }} {{ step_data.reprezentant_prenume }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        In calitate de
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.reprezentant_calitate_de }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Domiciliat in
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{
                                            `Loc. ${
                                                step_data.reprezentant_localitate
                                            }, Jud. ${
                                                step_data.reprezentant_judet
                                            }, Str. ${
                                                step_data.reprezentant_strada
                                            }, Nr. ${
                                                step_data.reprezentant_numar
                                            }, Bloc ${
                                                step_data.reprezentant_bloc ?? '-'
                                            }, Scara ${
                                                step_data.reprezentant_scara ?? '-'
                                            }, Etaj ${
                                                step_data.reprezentant_etaj ?? '-'
                                            }, Ap. ${
                                                step_data.reprezentant_apartament ?? '-'
                                            }`
                                        }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-full">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Act identitate
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        Identificat prin {{ step_data.reprezentant_act_identitate_tip }}, Seria
                                        {{ step_data.reprezentant_act_identitate_seria }}, Nr.
                                        {{ step_data.reprezentant_act_identitate_numar }}
                                        eliberat de {{ step_data.reprezentant_act_identitate_eliberat_de }}, la data {{
                                            step_data.reprezentant_act_identitate_eliberat_la_data
                                        }},
                                        CNP {{ step_data.reprezentant_act_identitate_cnp }}
                                    </dd>
                                </div>
                                <hr class="col-span-full">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        A savarsit
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.proces_verbal_fapta_locul }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        La data
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.proces_verbal_fapta_ziua }} la ora
                                        {{ step_data.proces_verbal_fapta_ora }}
                                    </dd>
                                </div>
                                <hr class="col-span-full">
                                <div class="sm:col-span-full">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Se aplica urmatoarele amenzi
                                    </dt>
                                </div>
                                <div v-for="amenda in step_data.amenzi" class="sm:col-span-full">
                                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 md:grid-cols-3">

                                        <hr class="col-span-full">

                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-bold text-gray-500">
                                                Prevederi incalcate
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{ amenda.prevederi_incalcate }}
                                            </dd>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-bold text-gray-500">
                                                Cu amenda
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                de la {{ amenda.amenda_de }} pana la
                                                {{ amenda.amenda_la }} cu amenda aplicata de {{
                                                    amenda.amenda_aplicata
                                                }}
                                            </dd>
                                        </div>

                                        <div class="sm:col-span-1">
                                            <dt class="text-sm font-bold text-gray-500">
                                                Sanctionat conform
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900">
                                                {{ amenda.sanctionare_conform }}
                                            </dd>
                                        </div>

                                    </dl>
                                </div>
                            </dl>
                        </div>
                    </DisclosurePanel>
                </div>
            </section>
        </disclosure>
    </div>
</template>

<script>

import DisclosurePane from "@/Components/DisclosurePane";

import FormTextInput from "@/Components/StepComponents/FormTextInput";
import FormBigTextInput from "@/Components/StepComponents/FormBigTextInput";
import Amenzi from "@/Components/StepComponents/Amenzi";
import FormReprezentant from "@/Components/StepComponents/Forms/FormReprezentant";
import FormularRegistrulComertului from "@/Components/StepComponents/Forms/FormularRegistrulComertului";
import FormularSediu from "@/Components/StepComponents/Forms/FormularSediu";

import {Disclosure, DisclosurePanel, DisclosureButton} from '@headlessui/vue';

export default {
    name: "ProcesVerbalForm",
    components: {
        FormularSediu,
        FormularRegistrulComertului,
        FormReprezentant,
        DisclosurePane,
        //
        FormTextInput,
        FormBigTextInput,
        Amenzi,

        Disclosure, DisclosurePanel, DisclosureButton
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
            form: {},
            agent_economic: ""
        }
    },
    mounted() {
        const done_steps = (this.$page.props.done_steps).filter(it => it.component == 'NotaConstatare');
        if (done_steps.length) {
            this.agent_economic = done_steps[0].data.agent_economic_nume;
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
}
</script>

<style scoped>

</style>
