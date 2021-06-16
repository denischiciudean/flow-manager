<template>
    <div class="sm:col-span-6">
        <label for="cover_photo" class="block text-sm font-medium text-gray-700">
            Document
        </label>
        <div
            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center" v-if="!fixed_value">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                     v-if="!fixed_value"
                     viewBox="0 0 48 48" aria-hidden="true">
                    <path
                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="flex text-sm justify-center text-gray-600">
                    <label for="file-upload"
                           class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>{{ file_name }}</span>
                        <input id="file-upload" name="file-upload" ref="file_upload" type="file"
                               v-bind:multiple="multiple"
                               @change="e => handleFileUpload(e)"
                               class="sr-only"/>
                    </label>
                    <p class="pl-1" v-if="!file_name.includes('.')">Sau trage si lasa aici</p>
                </div>
                <div v-if="uploaded_docs.length" class="flex flex-row justify-evenly flex-wrap w-full">
                    <div
                        class="py-1 flex flex-row justify-between px-2 rounded-lg text-white my-1 border-1 border border-purple-400 w-1/3 flex-shrink-1 mx-2"
                        style="min-width: 200px"
                        v-for="(file, index) in uploaded_docs">
                        <div class="w-3/4 text-xs text-purple-400 pr-2">
                            {{ file.name }}
                        </div>
                        <div class="right w-1/4">
                            <div class="rounded-full bg-purple-400 p-1 flex flex-row justify-center cursor-pointer"
                                 @click="removeFile(index)">
                                <x-icon style="min-width: 20px; max-width: 20px"/>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-500">
                    PNG, JPG, GIF up to 10MB
                </p>
            </div>

            <div class="space-y-1 text-center" v-else>
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                     v-if="!fixed_value"
                     viewBox="0 0 48 48" aria-hidden="true">
                    <path
                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div v-if="fixed_value.length" class="flex flex-row justify-evenly flex-wrap w-full">
                    <div
                        class="py-1 flex flex-row justify-between px-2 rounded-lg my-1 border-1 border border-purple-400 w-1/3 flex-shrink-1 mx-2 text-purple-400 hover:bg-purple-400 hover:text-white"
                        style="min-width: 200px"
                        v-for="(file, index) in uploaded_docs">
                        <a class="flex-grow align-middle" :href="`${file.href}`">
                            <div class="w-full text-xs  pr-2">
                                {{ file.basename }}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

import {XIcon} from '@heroicons/vue/outline'

export default {
    components: {
        XIcon
    },
    name: "FileUpload",
    props: [
        'display',
        'data_key',
        'fixed_value',
        'as_display',
        'multiple',
        'step'
    ],
    data() {
        return {
            file_name: 'Incarca un fisier',
            display: false,
            uploaded_docs: []
        }
    },
    watch: {
        uploaded_docs: function (_new, _old) {
            this.$emit('changed', [this.data_key, this.uploaded_docs])
        }
    },
    mounted() {
        if (this.fixed_value) {
            this.uploaded_docs = this.fixed_value.map(it => {
                const basename = this.basename(it);
                return {
                    basename,
                    href: `/view-file/${this.step.id}/${this.data_key}/${basename}`
                }
            });
        }
    },
    methods: {
        basename: (path) => path.substring(path.lastIndexOf('/') + 1),
        handleFileUpload(e) {
            this.uploaded_docs = [...this.uploaded_docs, ...e.target.files];
        },
        removeFile(index) {
            this.uploaded_docs.splice(index, 1);
        }
    }
}
</script>

<style scoped>
</style>
