import './bootstrap';
import 'vue3-toastify/dist/index.css'
import '../css/app.css';

import {createApp, h} from 'vue';
import {createInertiaApp, Link} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import vuetify from './plugins/vuetify';
import Vue3Toastify from 'vue3-toastify';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .use(Vue3Toastify)
            .component('Link', Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
}).then(() => {

});
