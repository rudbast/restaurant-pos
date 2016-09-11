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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UsersController@index');
    Route::post('/', 'UsersController@store');
    Route::get('/{user}', 'UsersController@show');
    Route::put('/{user}/edit', 'UsersController@update');
    Route::delete('/{user}/delete', 'UsersController@destroy');
});
