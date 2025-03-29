const mix = require('laravel-mix');

/* Basic CSS/JS setup */
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version();
