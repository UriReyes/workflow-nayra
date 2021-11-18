const mix = require('laravel-mix');
const path = require('path');
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
        module: {
            rules: [
                // ... other rules omitted

                // this will apply to both plain `.scss` files
                // AND `<style lang="scss">` blocks in `.vue` files
                {
                    test: /\.scss$/,
                    use: [
                        'sass-loader'
                    ]
                },
            ],
        },
    })
    .vue({
        extractVueStyles: true,
        globalVueStyles: 'resources/js/assets/scss/settings/_settings.variables.scss',
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
