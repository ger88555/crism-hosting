const mix = require('laravel-mix');

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

mix
    // Frontoffice assets
    .scripts('resources/assets/frontoffice/css/*.css', 'public/css/frontoffice.css')
    .scripts([
        'resources/assets/frontoffice/js/jquery-1.11.1.js',
        'resources/assets/frontoffice/js/bootstrap.js',
        'resources/assets/frontoffice/js/custom.js',
    ], 'public/js/frontoffice.js')
    .copyDirectory('resources/assets/frontoffice/img', 'public/frontoffice/img')
    .copyDirectory('resources/assets/frontoffice/fonts', 'public/frontoffice/fonts')

    // Backoffice assets
    .js('resources/assets/backoffice/js/app.js', 'public/js')
    .postCss('resources/assets/backoffice/css/app.css', 'public/css');
