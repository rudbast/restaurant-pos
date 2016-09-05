const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir.config.sourcemaps = false;

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');

    mix.scripts([
        'plugins/metisMenu/jquery.metisMenu.js',
        'plugins/slimscroll/jquery.slimscroll.min.js',
        'inspinia.js',
        'plugins/pace/pace.min.js'
    ], 'public/js/plugins.js');

    mix.styles([
        'font-awesome.min.css',
        'animate.css',
        'style.css'
    ], 'public/css/plugins.css');

    mix.copy('resources/assets/fonts', 'public/fonts');
    mix.copy('resources/assets/css/patterns', 'public/css/patterns');
});
