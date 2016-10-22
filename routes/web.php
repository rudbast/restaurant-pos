<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect()->action('HomeController@index');
});

Auth::routes();

Route::get('home', 'HomeController@index');

Route::get('lang/{lang}', 'LanguageController@select');

Route::resource('users', 'UsersController', ['except' => [
    'create', 'edit'
]]);

Route::resource('menus', 'MenusController', ['except' => [
    'create', 'edit'
]]);
