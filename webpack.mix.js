const mix = require('laravel-mix');
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
// require('laravel-mix-alias');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        plugins: [new VueLoaderPlugin()]
    })
    .vue({
        globalStyles: 'resources/scss/index.scss',
    })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

// .sass('resources/js/components/modeler/assets/scss/index.scss', 'public/css')
mix.alias({
    '@': 'resources/js',
});
