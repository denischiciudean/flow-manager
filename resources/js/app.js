require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import 'vue-search-select/dist/VueSearchSelect.css'

import vSelect from 'vue-search-select';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .use(vSelect)
    .mixin({methods: {route}})
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({color: '#4B5563'});
