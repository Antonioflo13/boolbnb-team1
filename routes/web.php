<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Braintree\Gateway;

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

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group( function() {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('appartments/promotions/{appartment}', 'PromotionController@show')->name('promotions');
        Route::get('appartments/payment/{promotion}/{appartment}', 'PromotionController@getToken')->name('getToken');
        Route::post('appartments/payment/{promotion}/{appartment}', 'PromotionController@payment')->name('payment');
        Route::resource('appartments', 'AppartmentController');

});

Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');
