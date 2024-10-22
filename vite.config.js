import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    optimizeDeps: {
        include: ['pdfjs-dist'], // optionally specify dependency name
        esbuildOptions: {
            supported: {
                'top-level-await': true,
            },
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/tabler/src/js/tabler.esm.js',
                'resources/js/index.js',
                'resources/js/libs/constants.js',
                'resources/js/libs/popper.js',
                'resources/js/libs/poppers.js',
                'resources/js/libs/slide.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: '',
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~tabler': path.resolve(__dirname, 'resources/tabler'),
        },
    },
});
