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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //
    Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
        // Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('clients', 'Admin\ClientsController');
        Route::resource('plans', 'Admin\PlansController');
        Route::resource('users', 'Admin\UsersController');
        Route::resource('questions', 'Admin\QuestionsController');
        Route::resource('texts', 'Admin\TextsController');
    });
    Route::group(['middleware' => ['client']], function() {

    });
});
