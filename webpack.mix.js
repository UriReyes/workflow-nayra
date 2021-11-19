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
        plugins: [new VueLoaderPlugin()],
        module: {
            rules: [
                {
                    test: /\.bpmnlintrc$/,
                    use: 'bpmnlint-loader',
                },
                {
                    test: /\.vue$/,
                    loader: 'vue-loader',
                },
                {
                    test: /\.js$/,
                    loader: 'babel-loader',
                    exclude: /node_modules/,
                },
            ]
        },
        externals: (() => {
            const externals = [];
            if (process.env.NODE_ENV === 'production') {
                externals.push(
                    'vue',
                    /^bootstrap\/.+$/,
                    /^@processmaker\/(?!processmaker-bpmn-moddle).+$/,
                    /^@fortawesome\/.+$/,
                    'jointjs',
                    'i18next',
                    '@panter/vue-i18next',
                    'luxon',
                    'lodash',
                    'bpmn-moddle',
                );
            }
            return externals;
        })(),
        resolve: {
            extensions: ['.js', '.vue', '.json'],
            modules: [
                path.resolve(__dirname, 'node_modules'),
                'node_modules',
            ],
            symlinks: false,
        },
        devtool: 'source-map',
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
