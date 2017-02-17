<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::post('/upload', 'HomeController@upload');

Route::group(['prefix' => 'api'], function()
{
    Route::resource('datasets', 'DatasetController', ['only' => [
        'index', 'show'
    ]]);

    Route::resource('states', 'StateController', ['only' => [
        'index', 'show'
    ]]);
});
