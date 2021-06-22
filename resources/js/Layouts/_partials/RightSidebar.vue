<template>
    <aside class="hidden xl:block xl:col-span-4">
        <div class="sticky top-4 space-y-4">
            <section aria-labelledby="who-to-follow-heading">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 id="who-to-follow-heading" class="text-base font-bold text-gray-900">
                            Mesaje Primite
                        </h2>
                        <div class="mt-6 flow-root">
                            <ul class="-my-4 divide-y divide-gray-200">
                                <li v-for="message in $page.props.messages" :key="message.id"
                                    class="flex items-center py-4 space-x-3 border-b border-1">
                                    <div class="min-w-0 flex-1 flex-grow">
                                        <div class="text-sm font-medium text-gray-900">
                                            <span
                                                class="text-gray-500 font-bold my-2">Nota : {{ message.task.title }}</span>
                                            <span class="text-gray-500 my-2"
                                                  v-html="proxyGenerateHtml(message.content)"></span>
                                            <inertia-link :href="message.href"
                                                          class="text-gray-500 text-xs float-right">Citeste >>>
                                            </inertia-link>
                                        </div>
                                        <div class="mt-2">
                                            @{{ message.created_by.name }} acum
                                            {{ parseInt(((Date.now() / 1000 - message.created_at) / 60)) }} minute
                                        </div>
                                    </div>
                                    <hr>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-6">
                            <a href="#"
                               class="w-full block text-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                View all
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </aside>
</template>

<script>
import {generateHTML} from '@tiptap/core';
import Document from '@tiptap/extension-document'

import Paragraph from '@tiptap/extension-paragraph'

import Text from '@tiptap/extension-text'

import Mention from '@tiptap/extension-mention'

import CommentMentionList from "@/Components/CommentMentionList";

export default {
    name: "RightSidebar",

    data() {
        return {}
    },
    methods: {
        proxyGenerateHtml(msg) {
            return generateHTML(msg, [
                Text,
                Paragraph,
                Document,
                Mention.configure({
                    HTMLAttributes: {
                        class: 'bg-blue-400 px-2 rounded text-white',
                    }
                }),
            ]);
        }
    }
}
</script>

<style scoped>

</style>
