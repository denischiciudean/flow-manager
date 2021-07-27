<template>
    <div>
        <div class="w-full">
            <div class="bg-white w-full h-auto  px-3 py-2 flex flex-col space-y-2"
                 v-for="comment in display_comments">
                <div class="flex items-center space-x-2">
                    <div class="group relative flex flex-shrink-0 self-start cursor-pointer">
                        <img
                            :src="`https://eu.ui-avatars.com/api/?name=${comment.user ?? 'User'}`"
                            alt="" class="h-8 w-8 object-fill rounded-full">
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <div class="block">
                            <div class="flex justify-center items-center space-x-2">
                                <div class="bg-gray-100 w-auto rounded-xl px-2 pb-2">
                                    <div class="font-medium">
                                        <a href="#" class="hover:underline text-sm font-bold">
                                            <small>{{ comment.user }}</small>
                                        </a>
                                    </div>
                                    <div class="text-xs break-all" v-html="comment.editor"></div>
                                </div>
                            </div>
                            <!-- New Subcomment Paste Here !! -->
                        </div>
                    </div>
                </div>
            </div>


            <div class="bg-white w-full h-auto  px-3 py-2 flex flex-col space-y-2" v-if="$page.props.current_step">
                <div class="flex items-center w-full">
                    <div class="flex items-center justify-center w-full">
                        <div class="w-full">
                            <div class="flex justify-center items-center  w-full">

                                <div class="shadow border-1 border-solid w-auto rounded-xl px-2 py-2 w-full">
                                    <div class="flex flex-row" v-if="editor">
                                        <!--                                        ADD EHERE-->
                                        <editor-content class="w-full border-2 border-solid border-gray-300 rounded-lg" :editor="editor"/>
                                        <button @click="addComment"
                                                class="py-2 px-2 mx-3 rounded bg-green-500 text-white font-bold">Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative">
                                <div class="flex flex-col">
                                    <div
                                        v-for="(user, i) in suggestions"
                                        @click="mentionUser(user, i)"
                                        :key="`user_mention_${user.id}`"
                                        class="h-10 cursor-pointer hover:bg-gray-200 hover:text-gray-500 p-3 my-2 shadow rounded-lg"
                                    >
                                        {{ user.name }}
                                    </div>
                                </div>
                            </div>
                            <!-- New Subcomment Paste Here !! -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

import tippy from 'tippy.js'

import {Editor, EditorContent, VueRenderer} from '@tiptap/vue-3'

import {generateHTML} from '@tiptap/core';

import Document from '@tiptap/extension-document'

import Paragraph from '@tiptap/extension-paragraph'

import Text from '@tiptap/extension-text'

import Mention from '@tiptap/extension-mention'

import CommentMentionList from "./CommentMentionList";

// import MentionList from './MentionList'

export default {
    name: "CommentsSection",
    components: {
        EditorContent,
        CommentMentionList
    },

    props: [
        'comments',
        'type',
        'mentionable_users'
    ],
    data() {
        return {
            display_comments: [],
            text: 'asdasd ',
            mentions: [],
            suggestions: [],
            editor: null,
            editable: true,
            mention: null
        }
    },
    mounted() {
        this.mention = Mention.configure({
            HTMLAttributes: {
                class: 'bg-blue-400 px-2 rounded text-white',
            },
            suggestion: {
                items: query => {
                    return this.mentionable_users.filter(item => item.name.toLowerCase().startsWith(query.toLowerCase())).slice(0, 10)
                },
                render: () => {
                    let component = null;
                    let popup = null;

                    return {
                        onStart: function (props) {
                            component = new VueRenderer(CommentMentionList, {props, editor: props.editor})

                            popup = tippy('body', {
                                getReferenceClientRect: props.clientRect,
                                appendTo: () => document.body,
                                content: component.element,
                                showOnCreate: true,
                                interactive: true,
                                trigger: 'manual',
                                placement: 'bottom-start',
                            })
                        },

                        onUpdate(props) {
                            component.updateProps(props)

                            popup[0].setProps({
                                getReferenceClientRect: props.clientRect,
                            })
                        },
                        onKeyDown(props) {
                            return component.ref?.onKeyDown(props)
                        },
                        onExit() {
                            popup[0].destroy()
                            component.destroy()
                        },
                    };
                },
            },
        });

        this.editor = new Editor({
            extensions: [
                Document,
                Paragraph,
                Text,
                this.mention,
            ],
            editable: this.editable,
            content: ' ',
        })

        this.display_comments = this.comments.map(it => {
            it.editor = generateHTML(it.content, [
                Document,
                Paragraph,
                Text,
                this.mention,
            ])
            return it;
        });

    },
    beforeUnmount() {
        this.editor.destroy()
    },
    methods: {

        handleCommentError() {

        },

        async addComment() {
            let data = this.editor.getJSON();
            axios.post('/api/add-comment', {
                type: 'task',
                content: data,
                task_id: this.$page.props.task.id
            }).then(it => it.data.data.status == 'success' ? location.reload() : this.handleCommentError())
        }

    },


}
</script>

<style scoped lang="scss">
.ProseMirror {
    > * + * {
        margin-top: 0.75em;
    }
}


</style>
