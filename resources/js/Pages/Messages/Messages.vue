<template>
    <main-layout>
        <template #left-sidebar>
            <left-sidebar/>
        </template>
        <div class="text-2xl font-bold mb-2">Mesagerie</div>

        <div class="mb-5 pb-5">
            <custom-dropdown
                data_key="selected_state"
                :states="message_states"
                @changed="modifiedInput"/>
        </div>
        <div class=" flex flex-col w-full mt-5">
            <div class="mt-4 flex-grow flex flex-col bg-white rounded p-3" v-if="messages.length"
                 v-for="message in messages">
                <div class="w-full flex items-center space-x-2 mb-2">
                    <div class="group h-full flex items-center justify-center self-start cursor-pointer ">
                        <img
                            :src="`https://eu.ui-avatars.com/api/?name=${message.from.name ?? 'User'}`"
                            alt="" class="h-8 w-8 object-fill rounded-full">
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="block">
                            <div class="flex justify-center items-center space-x-2">
                                <div class="w-auto rounded-xl pl-2">
                                    <div class="font-medium">
                                        <a href="#" class="hover:underline text-sm font-bold">
                                            <small>{{ message.from.name }}</small>
                                        </a>
                                    </div>
                                    <div class="text-xs break-all"> Acum {{ message.from.since }} minute</div>
                                </div>
                            </div>
                            <!-- New Subcomment Paste Here !! -->
                        </div>
                    </div>
                </div>
                <div class=" my-2" v-html="message.message_content"/>
                <div class="flex flex-row py-2">
                    <div class=" hover:underline cursor-pointer">
                        Raspunde
                    </div>
                    <div class="ml-4 hover:underline cursor-pointer">
                        Marcheaza ca citit
                    </div>
                </div>
                <inertia-link :href="message.href">
                    <div class="mt-3 border-2 border-dashed border-black rounded py-2 px-4 hover:bg-gray-200">
                        <div class="text-gray-600 font-bold uppercase">
                            {{ message.task.task_series }}
                        </div>
                        <div class="text-sm truncate md:overflow-clip">
                            {{ message.task.title }}
                        </div>
                    </div>
                </inertia-link>
            </div>
            <div v-else class="flex flex-row w-full mt-5">
                <div class="mt-4 flex-grow flex flex-col bg-white rounded p-3 font-medium">
                    Nici un mesaj
                </div>
            </div>
        </div>


    </main-layout>
</template>

<script>

import CustomDropdown from "../../Components/CustomDropdown";

import {generateHTML} from '@tiptap/core';
import Text from '@tiptap/extension-text';
import Paragraph from '@tiptap/extension-paragraph';
import Document from '@tiptap/extension-document';
import Mention from '@tiptap/extension-mention';

const message_states = [
    {slug: 'toate', name: 'Toate'},
    {slug: 'recente', name: 'Recente'},
    {slug: 'prioritare', name: 'Prioritare'},
];
//
// const messages = [
//     {
//         from: {name: 'Lorem Ipsum', since: 32},
//         message_content: {
//             "type": "doc",
//             "content": [{
//                 "type": "paragraph",
//                 "content": [{
//                     "type": "mention",
//                     "attrs": {"id": "carmelo-roberts", "label": "Carmelo Roberts"}
//                 }, {"text": "salutare ce faci?", "type": "text"}]
//             }]
//         },
//         task: {title: 'task title', task_series: 'somehow retrieve it lol'}
//     }
// ];

import MainLayout from "../../Layouts/MainLayout";
import LeftSidebar from "../../Layouts/_partials/LeftSidebar";

export default {
    name: "Messages",
    props: [
        'messages'
    ],
    components: {
        CustomDropdown,
        LeftSidebar,
        MainLayout,
    },
    data() {
        return {
            selected_state: null,
            message_states,
            formatted_message: []
        }
    },
    created() {
        this.formatted_message = this.messages.map(it => {
            it.message_content = generateHTML(it.message_content, [Document, Paragraph, Text, Mention])
            return it
        })
    },
    watch: {
        selected_state: function () {
            this.filter()
        }
    },
    methods: {
        modifiedInput([key, data]) {
            this[key] = data;
        },
        filter() {
            /**
             * Filter the messages somehow
             */
            console.log("changed")
        }
    }
}
</script>

<style scoped>

</style>
