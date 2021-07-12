<template>


    <div class="col-span-6 sm:col-span-3">
        <label for="first_name" class="block text-sm font-medium text-gray-700">
            {{ label_name }}
        </label>
        <input type="text" name="first_name" id="first_name"
               v-model="search_term"
               autocomplete="off"
               @keyup="search"
               @change="search"
               :disabled="fixed_value"
               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        <!--            <input type="text" placeholder="Placeholder"-->
        <!--                   v-model="search_term"-->
        <!--                   @keyup="search"-->
        <!--                   @change="search"-->
        <!--                   :disabled="fixed_value"-->
        <!--                   class="px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm border-0 shadow outline-none focus:outline-none focus:ring w-full"/>-->
        <Listbox @change="modifiedInput" v-show="results && results.length" style="z-index: 500" v-model="selected">
            <div class="relative">
                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="absolute z-30 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"

                        static>
                        <ListboxOption v-for="result in results"
                                       :key="result.id"
                                       :value="result.id"
                                       @click="e => modifiedInput(e)"
                                       as="div">
                            <li class="text-gray-900 cursor-pointer select-none relative py-2 pl-10 pr-4">
                                        <span class="font-normal block truncate">
                                          {{ result.name }}
                                        </span>
                            </li>
                        </ListboxOption>
                    </ListboxOptions>
                </transition>
            </div>
        </Listbox>
    </div>
</template>

<script>

import {
    Listbox, ListboxOption, ListboxOptions
} from '@headlessui/vue'

export default {
    components: {
        Listbox, ListboxOption, ListboxOptions
    },
    name: "UserSelect",
    props: ['label_name', 'classes', 'options', 'data_key', 'fixed_value'],
    data() {
        return {
            selected: 0,
            results: [],
            search_term: ''
        }
    },
    mounted() {
        if (this.fixed_value) {
            this.search_term = this.options.filter(it => it.id == parseInt(this.fixed_value))[0].name
        }
    },

    methods: {
        search() {
            let term = this.search_term
            if (!term) {
                this.results = [];
            }
            if (term && this.options) {
                this.results = this.options.filter(it => it.name.toLowerCase().includes(term.toLowerCase()))
            }
        },
        modifiedInput() {
            this.$emit('changed', [this.data_key, this.selected]);
            this.search_term = this.options.filter(it => it.id === this.selected)[0].name;
            this.results = [];
        }
    }

}
</script>

<style scoped>

</style>
