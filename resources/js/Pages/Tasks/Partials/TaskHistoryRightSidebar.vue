<template>
    <aside class="hidden xl:block xl:col-span-3">
        <div class="sticky top-4 space-y-4">
            <section aria-labelledby="who-to-follow-heading">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <div id="who-to-follow-heading" class="text-base font-medium text-gray-900">
                            <div v-for="(it, i) in $page.props.history" :key="it.id">
                                {{ i+1 }}. {{ it.note }}
                            </div>
                        </div>
                        <div class="mt-6 flow-root">
                            <ul class="-my-4 divide-y divide-gray-200">
                                <li class="flex items-center py-4 space-x-3">
                                    <div class="min-w-0 flex-1" v-if="assigned_to">
                                        <p class="text-sm font-medium text-gray-900">
                                            <span>{{ assigned_to.name }}</span>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            <span>{{ '@' + assigned_to.primary_department[0].name }}</span>
                                        </p>
                                    </div>
                                    <div v-else>
                                        <p class="text-sm font-medium text-gray-900">
                                            <span>Neatribuit</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-6" v-if="$page.props.allowed_to_reassign">
                            <button
                                @click="setIsOpen(true)"
                                class="w-full block text-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Reatribuie
                            </button>

                            <Dialog as="div" :open="isOpen" @close="setIsOpen">
                                <div class="fixed inset-0 z-10 overflow-y-scroll text-white">
                                    <div class="min-h-screen px-4 text-center">
                                        <DialogOverlay class="fixed inset-0"/>
                                        <div
                                            style="height:240px"
                                            class="inline-block w-full max-w-md p-6 my-8   overflow-hidden text-left align-middle transition-all transform bg-gray-600 border-purple-500 border-1 shadow-xl rounded-2xl"
                                        >

                                            <DialogTitle as="div" class="text-2xl text-white">
                                                Schimba Responsabil
                                            </DialogTitle>

                                            <div class="mt-2 ">
                                                <Listbox v-model="user">
                                                    <div class="relative mt-1">
                                                        <ListboxButton
                                                            class="relative w-full py-2 pl-3 pr-10 text-left bg-white rounded-lg shadow-md cursor-default focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm"
                                                        >
                                                            <span class="block truncate text-black">
                                                                {{
                                                                    selectedUser ? selectedUser.name : 'Select a user'
                                                                }}
                                                            </span>
                                                            <span
                                                                class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                                <SelectorIcon class="w-5 h-5 text-gray-400"
                                                                              aria-hidden="true"/>
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
                                                                    v-for="person in $page.props.reassign_users"
                                                                    :key="person.id"
                                                                    :value="person.id"
                                                                    as="template">
                                                                    <li :class="[
                                                                          active ? 'text-gray-900 bg-gray-100' : 'text-gray-900',
                                                                          'cursor-default select-none relative py-2 pl-10 pr-4',
                                                                        ]">
                                                                    <span
                                                                        :class="[
                                                                            selected ? 'font-medium' : 'font-normal',
                                                                            'block truncate',
                                                                          ]"
                                                                    >{{ person.name }}</span>
                                                                        <span
                                                                            v-if="selected"
                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                                                                        >
                                                                          <CheckIcon class="w-5 h-5"
                                                                                     aria-hidden="true"/>
                                                                        </span>
                                                                    </li>
                                                                </ListboxOption>
                                                            </ListboxOptions>
                                                        </transition>
                                                    </div>
                                                </Listbox>
                                                <!--                                                <select-->
                                                <!--                                                    v-model="user"-->
                                                <!--                                                    class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">-->
                                                <!--                                                    <option v-for="user in $page.props.reassign_users"-->
                                                <!--                                                            :key="`reassign-user-${user.id}`" :value="user.id">-->
                                                <!--                                                        {{ user.name }}-->
                                                <!--                                                    </option>-->
                                                <!--                                                </select>-->
                                            </div>
                                            <div class="mt-5">

                                                <button class="py-2 px-3 font-bold mt-2 bg-green-500 rounded mx-2"
                                                        @click="reassignUser()">Reatribuie
                                                </button>

                                                <button class="py-2 px-3 font-bold mt-2 bg-red-500 rounded mx-2"
                                                        @click="setIsOpen(false)">Iesi
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Dialog>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </aside>
</template>

<script>
import * as all_steps from "@/Steps";

import {
    CheckIcon,
    SelectorIcon
} from '@heroicons/vue/outline'

import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogDescription,
    Listbox,
    ListboxOptions,
    ListboxOption,
    ListboxButton
} from '@headlessui/vue'

export default {
    components: {
        ...all_steps,
        Dialog, DialogOverlay, DialogTitle, DialogDescription,
        Listbox, ListboxOptions, ListboxOption, ListboxButton,
        CheckIcon, SelectorIcon
    },
    name: "TaskHistoryRightSidebar",
    props: ['task', 'workflow', 'assigned_to'],
    data() {
        return {
            isOpen: false,
            user: null
        }
    },
    mounted() {
    },
    computed: {
        selectedUser() {
            return this.$page.props.reassign_users.filter(it => it.id == this.user)[0]
        }
    },
    methods: {
        setIsOpen(state) {
            this.isOpen = state
        },
        reassignUser() {
            this.$inertia.post(`/note/${this.$page.props.task.id}/${this.$page.props.task.slug}/reatribuie`, {
                step: this.$page.props.current_step.id,
                user: this.user
            })
        }
    }
}
</script>

<style scoped>

</style>
