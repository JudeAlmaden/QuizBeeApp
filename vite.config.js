import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery.js',        'resources/js/bootstrap.js'],
            refresh: true,
        }),
    ],   
    server:{
        host: '0.0.0.0',
        port: 8880,
        strictPort: true,
        hmr:{
            host:'192.168.1.9',
        }
    },
    input: [
        // rest of your inputs
        'resources/js/app.js',
        'resources/js/echo.js',
        'resources/js/jquery.js',
        'resources/js/bootstrap.js',
    ],define: {
    'process.env': {
        VITE_REVERB_APP_KEY: process.env.VITE_REVERB_APP_KEY,
        VITE_REVERB_HOST: process.env.VITE_REVERB_HOST,
        VITE_REVERB_PORT: process.env.VITE_REVERB_PORT,
        VITE_REVERB_SCHEME: process.env.VITE_REVERB_SCHEME,
    },
}

});