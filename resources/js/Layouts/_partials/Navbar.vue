<template>
    <Popover as="template" v-slot="{ open }">
        <header
            :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', 'bg-white shadow-sm lg:static lg:overflow-y-visible']">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative flex justify-center xl:grid xl:grid-cols-12 lg:gap-8">
                    <div class="flex md:absolute md:left-0 md:inset-y-0 lg:static xl:col-span-4">
                        <div class="flex-shrink-1 flex text-xl font-bold items-center hover:underline">
                            <inertia-link href="/dashboard" v-if="$page.props.department.name.length < 60">
                                {{ $page.props.department.name }}
                            </inertia-link>
                            <inertia-link href="/dashboard" v-else>
                                {{ $page.props.department.name.substr(0, 60) }}...
                            </inertia-link>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-4">
                        <div
                            class="flex items-center px-6 py-4 md:max-w-sm md:mx-auto lg:max-w-none lg:mx-0 xl:px-0">
                            <div class="w-full">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                        <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true"/>
                                    </div>
                                    <input id="search" name="search"
                                           autocomplete="off"
                                           @keyup="e => search(e.target.value)"
                                           class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-rose-500 focus:border-rose-500 sm:text-sm"
                                           placeholder="Search" type="search"/>
                                    <Listbox v-show="results.length" style="z-index: 500">
                                        <div class="relative">
                                            <transition
                                                leave-active-class="transition duration-100 ease-in"
                                                leave-from-class="opacity-100"
                                                leave-to-class="opacity-0"
                                            >
                                                <ListboxOptions
                                                    class="absolute w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                    static>
                                                    <ListboxOption v-for="result in results" :key="result.id"
                                                                   as="template">
                                                        <li class="text-gray-900 cursor-default select-none relative py-2 pl-10 pr-4">
                                                            <a :href="result.href">
                                <span class="font-normal block truncate">
                                  {{ result.title }}
                                </span>
                                                            </a>
                                                        </li>
                                                    </ListboxOption>
                                                </ListboxOptions>
                                            </transition>
                                        </div>
                                    </Listbox>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center md:absolute md:right-0 md:inset-y-0 lg:hidden">
                        <!-- Mobile menu button -->
                        <PopoverButton
                            class="-mx-2 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500">
                            <span class="sr-only">Open menu</span>
                            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true"/>
                            <XIcon v-else class="block h-6 w-6" aria-hidden="true"/>
                        </PopoverButton>
                    </div>
                    <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">

                        <!--            <a href="#"-->
                        <!--               class="ml-5 flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">-->
                        <!--              <span class="sr-only">View notifications</span>-->
                        <!--              <BellIcon class="h-6 w-6" aria-hidden="true"/>-->
                        <!--            </a>-->

                        <!-- Profile dropdown -->
                        <Menu as="div" class="flex-shrink-0 relative ml-5">
                            <div>
                                <MenuButton
                                    class="bg-white rounded-full flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full"
                                         :src="`https://eu.ui-avatars.com/api/?name=${$page.props.auth.user.name}`"
                                         alt=""/>
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-100"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                        <a @click="logout"
                                           :class="[0 ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">Logout</a>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                        <inertia-link href="/nota-noua/departament"
                                      class="ml-6 text-white inline-flex items-center font-bold hover:underline px-4 py-2 border-1 shadow border-transparent text-sm font-medium rounded-md shadow-sm bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Creaza Nota Noua
                        </inertia-link>
                    </div>
                </div>
            </div>

            <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
                <div class="max-w-3xl mx-auto px-2 pt-2 pb-3 space-y-1 sm:px-4">
                    <a @click="logout"
                       :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">Logout</a>
                </div>
                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="max-w-3xl mx-auto px-4 flex items-center sm:px-6">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt=""/>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                        </div>
                        <button type="button"
                                class="ml-auto flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">
                            <span class="sr-only">View notifications</span>
                            <BellIcon class="h-6 w-6" aria-hidden="true"/>
                        </button>
                    </div>
                    <div class="mt-3 max-w-3xl mx-auto px-2 space-y-1 sm:px-4">
                        <a @click="logout"
                           :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">Logout</a>
                    </div>
                </div>
            </PopoverPanel>
        </header>
    </Popover>

</template>

<script>

import {
    FireIcon,
    HomeIcon,
    TrendingUpIcon,
    UserGroupIcon,
    XIcon,
    BellIcon,
    MenuIcon,
    SearchIcon
} from "@heroicons/vue/outline/esm";

import {
    Popover, PopoverPanel, Menu, MenuItems, MenuItem, MenuButton,
    Listbox, ListboxButton, ListboxOption, ListboxOptions, ListboxLabel
} from '@headlessui/vue';


const user = {
    name: 'Chelsea Hagon',
    email: 'chelseahagon@example.com',
    imageUrl:
        'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}

const navigation = [
    {name: 'Home', href: '#', icon: HomeIcon, current: true},
    {name: 'Popular', href: '#', icon: FireIcon, current: false},
    {name: 'Communities', href: '#', icon: UserGroupIcon, current: false},
    {name: 'Trending', href: '#', icon: TrendingUpIcon, current: false},
]

const userNavigation = [
    {name: 'Your Profile', href: '#'},
]

export default {
    name: "navbar",
    components: {
        Popover,
        PopoverPanel, Menu, MenuItems, MenuItem, MenuButton,
        Listbox, ListboxButton, ListboxOption, ListboxOptions, ListboxLabel,
        XIcon, BellIcon, MenuIcon, SearchIcon
    },
    data() {
        return {
            navigation,
            userNavigation,
            user,
            results: []
        }
    },
    methods: {
        logout() {
            this.$inertia.post('/logout')
        },
        async search(term) {
            if (term === '') {
                this.results = [];
            } else {
                let res = await axios.get(`/search-tasks/${term}`);
                this.results = res.data.data;
            }
        }
    }
}
</script>

<style scoped>

</style>
