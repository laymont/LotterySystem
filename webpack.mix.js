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

mix.scripts([
            'jquery-3.2.1.min.js',
            'moment.js',
            'holder.min.js'
            'popper.min.js',
            'bootstrap.min.js',
            'popover.js',
            'moment.js',
            'axios.js',
            'vue.js',
            'chart.js',
            'sweetalert.min.js'
            ], 'public/js');
   // .sass('resources/assets/sass/app.scss', 'public/css');
