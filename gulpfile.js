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
    /** Main */
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

    mix.copy('resources/assets/fonts/fontawesome', 'public/fonts');
    mix.copy('resources/assets/fonts/bootstrap', 'public/fonts/bootstrap');
    mix.copy('resources/assets/css/patterns', 'public/css/patterns');

    /** Extra */
    // DataTables.
    mix.copy('resources/assets/css/plugins/dataTables/datatables.min.css', 'public/css/datatables.min.css');
    mix.copy('resources/assets/js/plugins/dataTables/datatables.min.js', 'public/js/datatables.min.js');

    // Chosen-select.
    mix.styles(['plugins/chosen/bootstrap-chosen.css'], 'public/css/bootstrap-chosen.css');
    mix.scripts(['plugins/chosen/chosen.jquery.js'], 'public/js/chosen.jquery.js');
    mix.copy('resources/assets/css/plugins/chosen/*.png', 'public/css');

    // Jquery Validation.
    mix.copy('resources/assets/js/plugins/validate/jquery.validate.min.js', 'public/js/jquery.validate.min.js');

    // Modal Form Validate.
    mix.scripts(['modal-form.js'], 'public/js/modal-form.js');
});
