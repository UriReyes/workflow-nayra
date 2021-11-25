const mix = require('laravel-mix');
const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const MonocoEditorPlugin = require('monaco-editor-webpack-plugin');
const plugins = [];
if (process.env.NODE_ENV !== 'production') {
    const MonocoEditorPlugin = require('monaco-editor-webpack-plugin');
    plugins.push(new MonocoEditorPlugin({
        languages: ['javascript', 'typescript', 'css', 'json'],
    }));
}

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

mix.js('resources/js/modelador.js', 'public/js')
    .webpackConfig({
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
            alias: {
                vue$: 'vue/dist/vue.esm.js',
                '@': path.resolve(__dirname, 'resources/js/modeler'),
            },
            symlinks: false,
        },
    })
    .vue({
        globalStyles: 'resources/scss/index.scss',
    });

mix.js('resources/js/constructorFormularios.js', 'public/js')
    .webpackConfig({
        plugins: [new MonocoEditorPlugin({
            languages: ['javascript', 'typescript', 'css', 'json'],
        })],

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
                '@@': path.resolve(__dirname, 'resources/js/screen-builder'),
            },
            symlinks: false,
        },
    })

// mix.alias({
//     '@': 'resources/js/modeler',
// });
