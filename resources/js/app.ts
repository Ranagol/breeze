import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp, Link } from '@inertiajs/vue3';//Importing Link
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = import.meta.env.VITE_APP_NAME || 'breeze';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve:
        (name) => resolvePageComponent(
            `./Pages/${name}.vue`,
            //how to trigger/render our Vue components from Pages dir, including all sub dirs in Pages
            import.meta.glob<DefineComponent>('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)//global registration of Link
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
