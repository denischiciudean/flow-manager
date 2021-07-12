<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  const colors = require('tailwindcss/colors')

  module.exports = {
    // ...
    theme: {
      extend: {
        colors: {
          rose: colors.rose,
        }
      }
    },
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ]
  }
  ```
-->
<template>
    <div class="min-h-screen bg-gray-100">
        <!-- When the mobile menu is open, add `overflow-hidden` to the `body` element to prevent double scrollbars -->
        <navbar/>
        <div class="py-10">
            <div class="mx-auto sm:px-6 lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
                <slot name="left-sidebar"></slot>
                <main
                    :class="[$slots['right-sidebar'] ? 'lg:col-span-9 xl:col-span-7' :'lg:col-span-9 xl:col-span-9']">
                    <slot/>
                </main>
                <slot name="right-sidebar"></slot>
            </div>
        </div>
    </div>
</template>

<script>

import {Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import {
    ChatAltIcon,
    CodeIcon,
    DotsVerticalIcon,
    EyeIcon,
    FlagIcon,
    PlusIcon,
    SearchIcon,
    ShareIcon,
    StarIcon,
    ThumbUpIcon,
} from '@heroicons/vue/solid'
import {BellIcon, FireIcon, HomeIcon, MenuIcon, TrendingUpIcon, UserGroupIcon, XIcon} from '@heroicons/vue/outline'
import LeftSidebar from "./_partials/LeftSidebar";
import RightSidebar from "./_partials/RightSidebar";
import Navbar from './_partials/Navbar';

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
    {name: 'Settings', href: '#'},
    {name: 'Sign out', href: '#'},
]
const communities = [
    {name: 'Movies', href: '#'},
    {name: 'Food', href: '#'},
    {name: 'Sports', href: '#'},
    {name: 'Animals', href: '#'},
    {name: 'Science', href: '#'},
    {name: 'Dinosaurs', href: '#'},
    {name: 'Talents', href: '#'},
    {name: 'Gaming', href: '#'},
]
const tabs = [
    {name: 'Recent', href: '#', current: true},
    {name: 'Most Liked', href: '#', current: false},
    {name: 'Most Answers', href: '#', current: false},
]
const questions = [
    {
        id: '81614',
        likes: '29',
        replies: '11',
        views: '2.7k',
        author: {
            name: 'Dries Vincent',
            imageUrl:
                'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
            href: '#',
        },
        date: 'December 9 at 11:43 AM',
        datetime: '2020-12-09T11:43:00',
        href: '#',
        title: 'What would you have done differently if you ran Jurassic Park?',
        body:
            '\n          <p>\n            Jurassic Park was an incredible idea and a magnificent feat of engineering, but poor protocols and a disregard for human safety killed what could have otherwise been one of the best businesses of our generation.\n          </p>\n          <p>\n            Ultimately, I think that if you wanted to run the park successfully and keep visitors safe, the most important thing to prioritize would be&hellip;\n          </p>\n        ',
    },
    // More questions...
]
const whoToFollow = [
    {
        name: 'Leonard Krasner',
        handle: 'leonardkrasner',
        href: '#',
        imageUrl:
            'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    },
    // More people...
]
const trendingPosts = [
    {
        id: 1,
        user: {
            name: 'Floyd Miles',
            imageUrl:
                'https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
        },
        body: 'What books do you have on your bookshelf just to look smarter than you actually are?',
        comments: 291,
    },
    // More posts...
]

export default {
    components: {
        Navbar,
        RightSidebar,
        LeftSidebar,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        Popover,
        PopoverButton,
        PopoverPanel,
        BellIcon,
        ChatAltIcon,
        CodeIcon,
        DotsVerticalIcon,
        EyeIcon,
        FlagIcon,
        MenuIcon,
        PlusIcon,
        SearchIcon,
        ShareIcon,
        StarIcon,
        ThumbUpIcon,
        XIcon,
    },
    setup() {
        return {
            user,
            userNavigation,
            communities,
            tabs,
            questions,
            whoToFollow,
            trendingPosts,
        }
    },
}
</script>
