<template>
    <!--    <div-->
    <!--        class="mt-8 mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">-->
    <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Description list-->
        <disclosure>
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow sm:rounded-lg">
                    <DisclosureButton class="w-full">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 id="applicant-information-title"
                                class="text-lg leading-6 text-left font-medium text-gray-900">
                                Nota Constatare
                            </h2>
                            <!--                    <p class="mt-1 max-w-2xl text-sm text-gray-500">-->
                            <!--                        Personal details and application.-->
                            <!--                    </p>-->
                        </div>
                    </DisclosureButton>
                    <DisclosurePanel>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 md:grid-cols-3">
                                <div class="sm:col-span-1" v-for="(agent, i) in agents_user_list">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Agent Constatator {{ i + 1 }}
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ agent.name }}
                                        <!--                                {{ step_data.agent_constatator_1 }}-->
                                    </dd>
                                </div>

                                <hr class="col-span-full">
                                <!-- AGENT ECONOMIC-->
                                <div class="sm:col-span-1 font-bold">
                                    <dt class="text-sm  text-gray-500">
                                        Agent economic
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.agent_economic_nume }}
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
                                <hr class="col-span-full">
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
                                            (new Date(parseInt(step_data.reprezentant_act_identitate_eliberat_la_data))).toLocaleDateString()
                                        }},
                                        CNP {{ step_data.reprezentant_act_identitate_cnp }}
                                    </dd>
                                </div>
                                <hr class="col-span-full">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Constatare
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_seria }}{{ step_data.constatare_nr }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Data
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ (new Date(parseInt(step_data.constatare_data))).toLocaleDateString() }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Unitatea situată la adresa
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_unitate_adresa }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Cu profil
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_unitate_profil }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        In prezenta
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_in_prezenta }}
                                    </dd>
                                </div>


                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        În calitate de
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_in_calitate_de }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Constatari
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.constatare_text }}
                                    </dd>
                                </div>
                                <hr class="col-span-full">

                                <div class="col-span-full">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Au fost prezentate
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <div class="mt-4 sm:mt-0 sm:col-span-2">
                                            <div class=" flex flex-wrap ">
                                                <div class="relative flex items-start w-1/2">
                                                    <div class="flex items-center h-5">
                                                        <input id="comments" name="comments" type="checkbox"
                                                               disabled
                                                               :checked="step_data.prezentare_autorizatie_functionare ? true : false"
                                                               class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                    </div>
                                                    <div class="ml-3 text-sm">
                                                        <label for="comments" class="font-medium text-gray-700">Autorizație
                                                            de
                                                            funcționare</label>
                                                    </div>
                                                </div>
                                                <div class="w-1/2">
                                                    <div class="relative flex items-start">
                                                        <div class="flex items-center h-5">
                                                            <input id="candidates" name="candidates" type="checkbox"
                                                                   disabled
                                                                   :checked="step_data.prezentare_ci ? true : false"
                                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="candidates" class="font-medium text-gray-700">Carte
                                                                de
                                                                Identitate (CI)</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="w-1/2">
                                                    <div class="relative flex items-start">
                                                        <div class="flex items-center h-5">
                                                            <input id="cui" name="candidates" type="checkbox"
                                                                   disabled
                                                                   :checked="step_data.prezentare_cui ? true : false"
                                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="cui"
                                                                   class="font-medium text-gray-700">CUI</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="w-1/2">
                                                    <div class="relative flex items-start">
                                                        <div class="flex items-center h-5">
                                                            <input id="offers" name="offers" type="checkbox"
                                                                   disabled
                                                                   :checked="step_data.prezentare_autorizatie_sanatate ? true : false"
                                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="offers" class="font-medium text-gray-700">Autorizație
                                                                de
                                                                sanatate</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </dd>
                                </div>

                                <hr class="col-span-full">

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Mentiuni
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.mentiuni }}
                                    </dd>
                                </div>

                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Masuri
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ step_data.masuri }}
                                    </dd>
                                </div>

                                <hr class="col-span-full">
                                <div class="col-span-full">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Proces Verbal
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span v-if="!!step_data.emis_proces_verbal">A fost emis un proces verbal</span>
                                        <span
                                            v-if="!!!step_data.emis_proces_verbal">Nu fost emis un proces verbal</span>
                                    </dd>
                                </div>

                                <hr class="col-span-full">
                                <div class="col-span-full"
                                     v-if="!!step_data.prezentare_sediu_data || !!step_data.prezentare_sediu_ora">
                                    <dt class="text-sm font-bold text-gray-500">
                                        Prezentare la sediu
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ (new Date(parseInt(step_data.prezentare_sediu_data))).toLocaleDateString() }}
                                        {{ step_data.prezentare_sediu_ora }}
                                    </dd>
                                </div>


                                <div class="col-span-full">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Attachments
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                            <li v-for="attachment in attachments" :key="attachment.name"
                                                class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                                <div class="w-0 flex-1 flex items-center">
                                                    <PaperClipIcon class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                                   aria-hidden="true"/>
                                                    <span class="ml-2 flex-1 w-0 truncate">
                              {{ attachment.name }}
                            </span>
                                                </div>
                                                <div class="ml-4 flex-shrink-0">
                                                    <a :href="attachment.href"
                                                       class="font-medium text-blue-600 hover:text-blue-500">
                                                        Download
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </DisclosurePanel>
                </div>
            </section>
        </disclosure>
    </div>
    <!--    </div>-->
</template>

<script>
import {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverOverlay,
    PopoverPanel,
    TransitionChild,
    TransitionRoot,
    Disclosure,
    DisclosureButton,
    DisclosurePanel

} from '@headlessui/vue'

import {
    ArrowNarrowLeftIcon,
    HomeIcon,
    PaperClipIcon,
    QuestionMarkCircleIcon,
    SearchIcon,
} from '@heroicons/vue/solid'

import {BellIcon, MenuIcon, XIcon} from '@heroicons/vue/outline'

import basename from '@/hooks/basename'

export default {
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,

        Menu,
        MenuButton,
        MenuItem,
        MenuItems,

        Popover,
        PopoverButton,
        PopoverOverlay,
        PopoverPanel,

        TransitionChild,
        TransitionRoot,

        ArrowNarrowLeftIcon,
        BellIcon,
        HomeIcon,
        MenuIcon,
        PaperClipIcon,
        QuestionMarkCircleIcon,
        SearchIcon,
        XIcon,
    },
    props: [
        'department',
        'workflow_id',
        'workflow_slug',
        'step',
        'step_data',
        'is_display'
    ],
    methods: {
        async retrieveUsers() {
            const res = await axios.get(`/api/mentionable-users?workflow_id=${this.workflow_id}`);
            this.agents_user_list = res.data.data.filter(it => [parseInt(this.step_data.agent_constatator_1), parseInt(this.step_data.agent_constatator_2)].includes(it.id));
            console.log(this.agents_user_list)
        }
    },
    data() {
        return {
            agents_user_list: []
        }
    },
    created() {
        this.retrieveUsers();
    },
    setup(props) {
        let {step_data, step} = props;
        let uploaded_docs = step_data.uploaded_doc.map(it => {
            const file_name = basename(it);
            return {
                name: file_name,
                href: `/view-file/${step.id}/uploaded_doc/${file_name}`
            }
        });
        return {
            attachments: uploaded_docs,
            /**
             * PROPS
             */
            step_data
        }
    },
}
</script>
