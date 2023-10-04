import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),  {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        },
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            vue : 'vue/dist/vue.esm-bundler.js',
            Swal : 'sweetalert2/dist/sweetalert2.js',
            '@': '/resources/js',
        }
    },
});
