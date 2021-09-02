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
        // Route::post('appartments/payment/success', 'PromotionController@payment')->name('payment');

        Route::post('/checkout', function (Request $request) {
            $gateway = new Braintree\Gateway([
                'environment' => config('services.braintree.environment'),
                'merchantId' => config('services.braintree.merchantId'),
                'publicKey' => config('services.braintree.publicKey'),
                'privateKey' => config('services.braintree.privateKey')
            ]);
        
            $amount = $request->amount;
            $nonce = $request->payment_method_nonce;
        
            $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'customer' => [
                    'firstName' => 'Andrea',
                    'lastName' => 'Casentini',
                    'email' => 'andrea.casentini@email.it'
                ],
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);
        
            if ($result->success) {
                $transaction = $result->transaction;
                // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        
                return back()->with('success_message', 'Transaction succesfull. The ID is:'.$transaction->id);
            } else {
                $errorString = "";
        
                foreach ($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }
        
                $_SESSION["errors"] = $errorString;
                // header("Location: " . $baseUrl . "index.php");
        
                return back()->withErrors('An error occurred with the message:'.$result->message);
            }
        });



        Route::resource('appartments', 'AppartmentController');

});

Route::get('{any?}', 'HomeController@index')->where('any', '.*')->name('home');
