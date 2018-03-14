let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/templates/bookingtour/js/custom.js', 'public/templates/bookingtour/js/custom.js')
   .js('resources/assets/templates/bookingtour/js/script.js', 'public/templates/bookingtour/js/script.js')
   .js('resources/assets/templates/bookingtour/js/activity-date.js', 'public/templates/bookingtour/js/activity-date.js')
   .styles('resources/assets/templates/bookingtour/css/style.css', 'public/templates/bookingtour/css/style.css')
   .styles('resources/assets/templates/bookingtour/css/activity-date.css', 'public/templates/bookingtour/css/activity-date.css')
   .styles('resources/assets/templates/bookingtour/css/mail-form.css', 'public/templates/bookingtour/css/mail-form.css')
   .copyDirectory('resources/assets/templates/bookingtour/images', 'public/templates/bookingtour/img')
   .copy('resources/assets/templates/bookingtour/js/modernizr.custom.js', 'public/templates/bookingtour/js/modernizr.custom.js')
   .styles('resources/assets/templates/admin/css/normalize.css', 'public/templates/admin/css/normalize.css')
   .styles('resources/assets/templates/admin/css/style.css', 'public/templates/admin/css/style.css')
   .js('resources/assets/templates/admin/js/plugins.js', 'public/templates/admin/js/plugins.js')
   .copyDirectory('resources/assets/templates/plugins', 'public/templates/plugins');
