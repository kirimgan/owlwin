const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.copy("./node_modules/bootstrap-sass/assets/fonts/bootstrap",'public/fonts/bootstrap');
    mix.sass('app.scss')
        .scripts([
            'libs/bootstrap-datepicker.min.js',
            'libs/loadingoverlay.js',
            'libs/clipboard.min.js'
        ]).styles(['libs/bootstrap-datepicker.css'])
       .webpack('app.js');
});
