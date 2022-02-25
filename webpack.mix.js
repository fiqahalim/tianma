const mix = require('laravel-mix');
const jsPath = 'resources/js/';
const cssPath = 'resources/css/';

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

mix.js(jsPath + 'app.js', 'public/js')
    .js(jsPath + 'pages/booking.js', 'public/js/pages')
    .js(jsPath + 'pages/profile.js', 'public/js/pages')
    .js(jsPath + 'pages/hierarchy.js', 'public/js/pages');

mix.postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.css(cssPath + 'pages/tree.css', 'public/css/pages')
    .css(cssPath + 'pages/booking.css', 'public/css/pages')
    .css(cssPath + 'pages/order.css', 'public/css/pages')
    .css(cssPath + 'pages/invoice.css', 'public/css/pages');

mix.webpackConfig({
    output: {
        chunkFilename: '[name]',
    },
});

if ( mix.inProduction() ) {
    mix.version();
}
mix.autoload({ 'jquery': ['window.$', 'window.jQuery', 'jQuery', '$'] })
