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
//pakage, plugin
   .sass('resources/assets/templates/pakages/css/dropzone.scss', 'public/css')
   .sass('resources/assets/templates/pakages/css/quill.snow.scss', 'public/css')
   .sass('resources/assets/templates/pakages/css/quill.bubble.scss', 'public/css')
   .copy('resources/assets/templates/pakages/js/quill.min.js', 'public/js')
   .copy('resources/assets/templates/pakages/js/bootstrap-select.min.js', 'public/js')
   .copy('resources/assets/templates/pakages/css/bootstrap-select.min.css', 'public/css')
   .copy('resources/assets/templates/pakages/js/screenfull.js', 'public/js')
   .copy('resources/assets/templates/pakages/js/dropzone.js', 'public/js')
   .copy('resources/assets/templates/pakages/js/image-resize.min.js', 'public/js')
   .copy('resources/assets/templates/pakages/css/bootstrap-datetimepicker.css', 'public/css')
   .copy('resources/assets/templates/pakages/js/bootstrap-datetimepicker.min.js', 'public/js')
   .copy('resources/assets/templates/pakages/css/select2.min.css', 'public/css')
   .copy('resources/assets/templates/pakages/js/select2.min.js', 'public/js')
   .copy('node_modules/moment/moment.js', 'public/js')
   .copyDirectory('node_modules/admin-lte/dist', 'public/admin-lte')
   .copyDirectory('resources/assets/templates/plugins', 'public/templates/plugins')
   .copyDirectory('node_modules/bootstrap/dist', 'public/bootstrap')
   .copyDirectory('node_modules/font-awesome', 'public/font-awesome')
   .copyDirectory('node_modules/jquery/dist', 'public/jquery')
   .copyDirectory('node_modules/datatables.net-bs/', 'public/datatables.net-bs')
   .copy('node_modules/datatables.net/js/jquery.dataTables.min.js', 'public/datatables.net-bs/js')
   .copy('node_modules/chart.js/dist/Chart.min.js', 'public/js')


//web
   .js('resources/assets/templates/bookingtour/js/custom.js', 'public/templates/bookingtour/js/custom.js')
   .js('resources/assets/templates/bookingtour/js/script.js', 'public/templates/bookingtour/js/script.js')
   .js('resources/assets/templates/bookingtour/js/activity-date.js', 'public/templates/bookingtour/js/activity-date.js')
   .styles('resources/assets/templates/bookingtour/css/style.css', 'public/templates/bookingtour/css/style.css')
   .styles('resources/assets/templates/bookingtour/css/activity-date.css', 'public/templates/bookingtour/css/activity-date.css')
   .styles('resources/assets/templates/bookingtour/css/mail-form.css', 'public/templates/bookingtour/css/mail-form.css')
   .copyDirectory('resources/assets/templates/bookingtour/images', 'public/templates/bookingtour/img')
   .copy('resources/assets/templates/bookingtour/js/modernizr.custom.js', 'public/templates/bookingtour/js/modernizr.custom.js')

//admin
   .styles('resources/assets/templates/admin/css/style.css', 'public/templates/admin/css/style.css')
   .copyDirectory('resources/assets/templates/admin/images', 'public/templates/admin/images')
   .options({
        processCssUrls: false,
    })
   .sass('resources/assets/sass/admin/tour.scss', 'public/templates/admin/css/tour.css')
   .sass('resources/assets/sass/admin/hotel.scss', 'public/templates/admin/css/hotel.css')
   .sass('resources/assets/sass/admin/booking.scss', 'public/templates/admin/css/booking.css')
   .sass('resources/assets/sass/admin/login.scss', 'public/templates/admin/css/login.css')
   .sass('resources/assets/sass/admin.scss', 'public/templates/admin/css/admin.css')

   .js('resources/assets/templates/admin/js/main.js', 'public/templates/admin/js/main.js')
   .js('resources/assets/templates/admin/js/tour.js', 'public/templates/admin/js/tour.js')
   .js('resources/assets/templates/admin/js/hotel.js', 'public/templates/admin/js/hotel.js')
   .js('resources/assets/templates/admin/js/guide.js', 'public/templates/admin/js/guide.js')
   .js('resources/assets/templates/admin/js/booking.js', 'public/templates/admin/js/booking.js')
   .js('resources/assets/templates/admin/js/dashboard.js', 'public/templates/admin/js/dashboard.js')
   .js('resources/assets/templates/admin/js/plugins.js', 'public/templates/admin/js/plugins.js');
