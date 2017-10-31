let mix = require('laravel-mix');

mix.js('resources/assets/js/bootstrap.js', 'public/js')
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
  //.copy('node_modules/vuetify/dist/vuetify.min.css', 'public/css');