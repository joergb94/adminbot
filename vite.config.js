import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/base-app.js',
                'resources/js/components/register/register-app.js',
                'resources/js/components/errors/error-app.js',
                'resources/js/components/login/login-app.js',
                'resources/js/components/home/home-app.js',
                'resources/js/components/entity/entity-app.js',
                'resources/js/components/billing/billing-app.js',
                'resources/js/components/bill/bill-app.js',
                'resources/js/components/verification/verification-app.js'
            ],
            refresh: true,
        }),
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
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': resolve(__dirname, './resources/js'),
        },
    },
    build: {
        chunkSizeWarningLimit: 1500,
        rollupOptions: {
            // external: [
            //     'primevue/resources/themes/primevue.min.css',
            //     'primevue/resources/themes/ary-blue/theme.css',
            //     'primeicons/primeicons.css',
            // ]
        }
    }
});
