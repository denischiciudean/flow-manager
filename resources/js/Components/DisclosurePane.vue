<template>
    <disclosure v-slot="{open}" :defaultOpen="opened" as="div">
        <disclosure-button class="w-full">
            <div class="mb-3 pt-0">
                <div class="flex flex-row align-middle justify-around">
                    <div class="mx-4 flex justify-between w-full">
                        <span class="text-lg font-medium">{{ title }}</span>
                        <chevron-up-icon
                            :class="open ? 'transform rotate-180 ' : ''"
                            class="w-5 h-5 text-purple-500 float-right transition"
                        />
                    </div>
                </div>
            </div>
        </disclosure-button>
        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >
            <disclosure-panel :unmount="false">
                <slot/>
            </disclosure-panel>
        </transition>
    </disclosure>

</template>

<script>
import {Disclosure, DisclosurePanel, DisclosureButton} from '@headlessui/vue';
import {ChevronUpIcon} from '@heroicons/vue/outline';

export default {
    name: "DisclosurePane",
    components: {
        Disclosure, DisclosureButton, DisclosurePanel,
        //
        ChevronUpIcon
    },
    props: ['title', 'default_open'],
    data() {
        return {}
    },
    computed: {
        opened() {
            return !!this.default_open;
        }
    },
    methods: {}
}
</script>

<style scoped>

</style>
