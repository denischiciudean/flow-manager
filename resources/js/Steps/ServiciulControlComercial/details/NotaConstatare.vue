<template>
    <!--    <div-->
    <!--        class="mt-8 mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">-->
    <div class="space-y-6 lg:col-start-1 lg:col-span-2">
        <!-- Description list-->
        <disclosure v-slot="{ open }">
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
                    <DisclosurePanel static>

                        <NotaConstatareFull
                            v-if="open"
                            :step_data="step_data"
                            :agents_user_list="agents_user_list"
                            :attachments="attachments"/>

                        <NotaConstatareSummary
                            v-else
                            :step_data="step_data"
                            :agents_user_list="agents_user_list"
                            :attachments="attachments"/>
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

import NotaConstatareFull from "./_partials_nota_constatare/NotaConstatareFull";
import NotaConstatareSummary from "./_partials_nota_constatare/NotaConstatareSummary";

export default {
    components: {
        NotaConstatareFull,
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

        NotaConstatareSummary
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
