import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/styles.css',
                'resources/css/bootstrap.min.css',
                'resources/css/custom.min.css',
                'resources/css/fontawesome.css',
                'resources/css/templatemo.min.css',
                'resources/css/fontawesome.min.css',
                'resources/js/bootstrap.js',
                'resources/js/bootstrap.js',
                'resources/js/custom.js',
                'resources/js/jquery-1.11.min.js',
                'resources/js/slick.min.js',
                'resources/js/jquery-migrate-1.2.1.min.js',
                'resources/js/templatemo.js',
                'resources/js/templatemo.min.js'
            ],
            refresh: true,
        }),
    ],
});
