import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'Modules/AvnChat/resources/assets/js/chat.js',
            ],
            refresh: true,

        }),
    ],
    server: {
        host: '192.168.20.84'
    },
});
