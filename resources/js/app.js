import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import { library } from '@fortawesome/fontawesome-svg-core';
import { faCheck, faXmark, faPlus, faMinus, faTrashCan, faLock, faStar } from '@fortawesome/free-solid-svg-icons';
import { faStar as faStarRegular, faStarHalfStroke } from '@fortawesome/free-regular-svg-icons';
library.add(faCheck, faXmark, faPlus, faMinus, faTrashCan, faLock, faStar, faStarHalfStroke, faStarRegular);

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
