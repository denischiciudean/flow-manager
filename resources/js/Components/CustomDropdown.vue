<template>
    <div class="w-72 fixed h-auto mb-5">
        <Listbox v-model="selected_state">
            <div class="mt-1 h-auto">
                <ListboxButton
                    class="h-auto w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm"
                >
                    <span class="block truncate">{{ selected_state.name }}</span>
                    <span
                        class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                    >
                                <SelectorIcon class="w-5 h-5 text-gray-400" aria-hidden="true"/>
                            </span>
                </ListboxButton>

                <transition
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <ListboxOptions
                        class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    >
                        <ListboxOption
                            v-slot="{ active, selected }"
                            v-for="state in states"
                            :key="state.name"
                            :value="state"
                            as="template"
                        >
                            <li :class="[
                  active ? 'text-amber-900 bg-amber-100' : 'text-gray-900',
                  'cursor-default select-none  py-2 pl-10 pr-4', ]">
                                    <span :class="[
                                        selected ? 'font-medium' : 'font-normal',
                                        'block truncate',
                                      ]">
                                        {{ state.name }}
                                    </span>
                                <span
                                    v-if="selected"
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                >
                                            <CheckIcon class="w-5 h-5" aria-hidden="true"/>
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

import {CheckIcon, SelectorIcon} from '@heroicons/vue/outline'

import {Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions} from '@headlessui/vue';


export default {
    name: "CustomDropdown",
    props: [
        'states',
        'data_key'
    ],
    components: {
        Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions,

        CheckIcon, SelectorIcon
    },
    data() {
        return {
            selected_state: null
        }
    },
    created() {
        this.selected_state = this.states[0]
    },
    watch: {
        selected_state: function () {
            this.emit()
        }
    },
    methods: {
        emit() {
            this.$emit('changed', [this.data_key, this.selected_state]);
        }
    }
}
</script>

<style scoped>

</style>
