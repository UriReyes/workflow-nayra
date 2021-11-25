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
mix.js('resources/js/constructorFormularios.js', 'public/js')
    .webpackConfig({
        plugins: [new VueLoaderPlugin()],
        module: {
            rules: [

                {
                    test: /\.vue$/,
                    loader: 'vue-loader',
                },
                {
                    test: /\.js$/,
                    loader: 'babel-loader',
                    exclude: /node_modules/,
                },
                {
                    test: /\.(png|jpg|gif)$/i,
                    use: [
                        {
                            loader: 'url-loader',
                            options: {
                                limit: 8192,
                            },
                        },
                    ],
                },
            ]
        },
        externals: process.env.NODE_ENV === 'production' ? [
            'vue-monaco',
            'monaco-editor',
            'vue-deepset',
            /^@fortawesome\/.+$/,
            'vue',
            'vuex',
            /^bootstrap\/.+$/,
            /^@processmaker\/.+$/,
            'i18next',
            '@panter/vue-i18next',
            'validatorjs',
        ] : [],
        resolve: {
            extensions: ['.js', '.vue', '.json'],
            modules: [
                path.resolve(__dirname, 'node_modules'),
                'node_modules',
            ],
            alias: {
                vue$: 'vue/dist/vue.esm.js',
                '@': path.resolve(__dirname, 'resources/js/screen-builder'),
            },
            symlinks: false,
        },
    })
    .vue();
// mix.alias({
//     '@': 'resources/js/modeler',
// });
