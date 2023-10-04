import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2/dist/sweetalert2.js'

window.bootstrap = bootstrap;
window.Swal = Swal;

import select2 from 'select2';
import "/node_modules/select2/dist/css/select2.css";
import * as FilePond from 'filepond';
window.FilePond = FilePond;
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
window.FilePondPluginImagePreview = FilePondPluginImagePreview;

import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


import jquery from 'jquery';

window.jquery = window.$ = jquery;


import Alpine from 'alpinejs'


window.Alpine = Alpine

// Caution, this will import all the icons and bundle them.

$(document).ready(function () {
    select2();
    Alpine.start();
    // $('.select2').select2();
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.setOptions({
        server: {
            url: '/temp',
            process: {
                url: '/process',
                method: 'POST',

            },
            revert: '/delete',
            patch: '?patch=',
            headers: {
                'X-CSRF-TOKEN': token.content
            }
            // process : ( fieldName, file, metadata, load, error, progress, abort, transfer, options) =>{
            //     @this.upload('{{$attributes['wire:model']}}',file,load,error,progress)
            // },
            // revert : ( fieldName, load) =>{
            // @this.removeUpload('{{$attributes['wire:model']}}',fileName,load)
            // }
        }
    });
});



import toastr from 'toastr';

window.toastr = toastr;






// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });




import {
    createApp
} from 'vue';

import {
    i18nVue
} from 'laravel-vue-i18n';


const files =
    import.meta.globEager('./components/*.vue');
const components = {};
const app = createApp();
Object.entries(files).forEach(([path, definition]) => {
    const componentName = path.split('/').pop().replace(/\.\w+$/, '')
    app.component(componentName, definition.default)
})

const projectsComponents = {};
let projectFiles =
    import.meta.globEager('../../Modules/Projects/Resources/assets/js/components/*.vue');
Object.entries(projectFiles).forEach(([path, definition]) => {
    const componentName = path.split('/').pop().replace(/\.\w+$/, '')
    app.component(componentName, definition.default)
})

app.use(i18nVue, {
    resolve: lang => import(`../lang/${lang}.json`),
});
app.mount('#app');
