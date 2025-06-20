import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/components/navbar.css',
                'resources/css/components/banner-section.css',
                'resources/css/components/product-section.css',
                'resources/css/components/service-section.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});

