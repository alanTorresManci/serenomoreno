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
Route::post('/subscribe', 'PaymentsController@subscribe')->name('subscribe');
Route::post('/subscribe', 'PaymentsController@sendEmail')->name('sendEmail');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', function(){
        \Auth::logout();
        return redirect()->route('home');
    })->name('logout');
    //
    Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
        // Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('clients', 'Admin\ClientsController');
        Route::resource('plans', 'Admin\PlansController');
        Route::resource('users', 'Admin\UsersController');
        Route::resource('questions', 'Admin\QuestionsController');
        Route::resource('texts', 'Admin\TextsController');
        Route::resource('products', 'Admin\ProductsController');
    });
    Route::group(['middleware' => ['client']], function() {
        Route::get('/payments/show', 'PaymentsController@show')->name('payments.show');
        Route::get('/payments/pay', 'PayPalController@pay')->name('payments.pay');
        Route::get('/payments/success', 'PayPalController@paypalReturn')->name('payments.success');
        Route::get('/payments/cancel/{token}', 'PayPalController@cancel')->name('paypal.cancel');
        Route::get('client/profile', 'ClientsController@show')->name('clients.profile');
        Route::get('client/cancel', 'ClientsController@cancel')->name('clients.cancel');
    });
});
