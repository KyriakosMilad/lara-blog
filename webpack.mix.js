const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// blog main
mix.js('resources/blog/js/app.js', 'public/js')
    .sass('resources/blog/sass/app.scss', 'public/css');

// admin main
mix.js('resources/admin/js/app.js', 'public/admin_js')
    .sass('resources/admin/sass/app.scss', 'public/admin_css');

// admin scripts
mix.scripts(
    [
        'resources/admin/js/jquery.min.js',
        'resources/admin/js/bootstrap.bundle.min.js',
        'resources/admin/js/jquery.easing.min.js',
        'resources/admin/js/admin.min.js',
    ], 'public/admin_js/admin.js');

// admin styles
mix.styles([
    'resources/admin/sass/all.min.css',
    'resources/admin/sass/admin.min.css',
], 'public/admin_css/admin.css');
