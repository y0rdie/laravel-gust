const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]);

mix.webpackConfig({
    resolve: {
        alias: {
            '@components': path.resolve(__dirname, 'resources/js/components'),
            '@layouts': path.resolve(__dirname, 'resources/js/layouts'),
            '@pages': path.resolve(__dirname, 'resources/js/pages'),
            '@plugins$': path.resolve(__dirname, 'resources/js/plugins'),
            '@router$': path.resolve(__dirname, 'resources/js/router'),
            '@services$': path.resolve(__dirname, 'resources/js/services'),
            '@stores$': path.resolve(__dirname, 'resources/js/stores'),
        },
    },
});

mix.disableSuccessNotifications();
