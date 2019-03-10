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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/bookingtour/custom.js', 'public/templates/bookingtour/js/custom.js')
   .js('resources/js/bookingtour/script.js', 'public/templates/bookingtour/js/script.js')
   .js('resources/js/bookingtour/activity-date.js', 'public/templates/bookingtour/js/activity-date.js')
   .styles('resources/sass/bookingtour/style.css', 'public/templates/bookingtour/css/style.css')
   .styles('resources/sass/bookingtour/activity-date.css', 'public/templates/bookingtour/css/activity-date.css')
   .styles('resources/sass/bookingtour/mail-form.css', 'public/templates/bookingtour/css/mail-form.css')
   .copyDirectory('resources/sass/images', 'public/templates/bookingtour/img')
   .copy('resources/assets/templates/bookingtour/js/modernizr.custom.js', 'public/templates/bookingtour/js/modernizr.custom.js')
   .styles('resources/sass/admin/normalize.css', 'public/templates/admin/css/normalize.css')
   .styles('resources/sass/admin/style.css', 'public/templates/admin/css/style.css')
   .js('resources/js/admin/main.js', 'public/templates/admin/js/main.js')
   .copy('node_modules/stylehacks/dist/plugins.js', 'public/js');
   .copyDirectory('resources/assets/templates/plugins', 'public/templates/plugins');
