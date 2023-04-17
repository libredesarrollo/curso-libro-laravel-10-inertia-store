import './bootstrap';
import '../css/app.css';

// ORUGA
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'
// ORUGA
// Material Design Icon
import '@mdi/font/css/materialdesignicons.min.css'


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import CKEditor from '@ckeditor/ckeditor5-vue';
import { vue3Debounce } from 'vue-debounce'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(CKEditor)
            .use(ZiggyVue, Ziggy)
            .use(Oruga);

        myApp.config.globalProperties.$step = 1;

        myApp
        .directive('debounce', vue3Debounce({ lock: true }))
        .mount(el);
        return myApp;

    },
    progress: {
        color: '#4B5563',
    },
});