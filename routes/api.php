<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->group(function() {
        Route::get('appartments','AppartmentController@index');
        Route::get('appartments/pagination','AppartmentController@paginateappartments');
        Route::get('appartments/{slug}','AppartmentController@show');
        Route::get('appartment/promotion','AppartmentController@promotion');
        Route::get('services','ServiceController@index');
        Route::post('locations', 'LocationController@index');
        Route::post('messages', 'MessageController@store');
        Route::post('distance', 'LocationController@distance');
    });
