<template>

    <aside class="hidden xl:block xl:col-span-3">
        <div class="sticky top-4 space-y-4">
            <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
                <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Timeline</h2>

                <!-- Activity Feed -->
                <div class="mt-6 flow-root">
                    <ul class="-mb-8">
                        <li v-for="(it, i) in $page.props.history" :key="it.id">
                            <div class="relative pb-8">
                                <span
                                    v-if="$page.props.history.length -1 !== i"
                                    class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                    aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span
                                            v-if="it.type == 'step_assigned'"
                                            class="h-8 w-8 rounded-full bg-gray-500 flex items-center justify-center ring-8 ring-white"
                                        >
                                            <svg class="w-5 h-5 text-white" x-description="Heroicon name: solid/user"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                              <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                          </span>
                                        <span
                                            class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white"
                                            v-else
                                        >
                                            <svg class="w-5 h-5 text-white" x-description="Heroicon name: solid/check"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" aria-hidden="true">
                                              <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                          </span>
                                    </div>
                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                        <div>
                                            <div class="text-sm text-gray-900">
                                                {{ it.note }}
                                                <br><span class="text-xs text-gray-500">Denis Chiciudean</span>
                                            </div>
                                        </div>
                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                            <time datetime="2020-09-20">
                                                {{ it.created_at }}
                                            </time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>


                    </ul>
                </div>
                <div class="mt-6 flex flex-col justify-stretch">
                    <div class="mt-6 flow-root">
                        <ul class="-my-4 divide-y divide-gray-200">
                            <li class="flex items-center py-4 space-x-3">
                                <div
                                    @click="setIsOpen(true)"
                                    class="w-full cursor-pointer px-2 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 flex flex-col"
                                    v-if="assigned_to">
                                    <div class="text-sm font-medium text-gray-900">
                                        <span>{{ assigned_to.name }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        <span>{{ '@' + assigned_to.primary_department[0].name }}</span>
                                    </div>
                                </div>
                                <div v-else class="w-full">
                                    <div
                                        @click="setIsOpen(true)"
                                        class="w-full cursor-pointer px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 flex flex-row items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ">
                                            <svg class="w-5 h-5 text-white" x-description="Heroicon name: solid/user"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="mx-2">
                                            Neatribuit
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

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
