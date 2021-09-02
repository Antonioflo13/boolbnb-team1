<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

use App\Promotion;
use App\Appartment;

class PromotionController extends Controller
{
    public function show(Appartment $appartment) {
        $promotions = Promotion::all();

        return view('admin.promotions.index', compact('promotions', 'appartment'));
    }    

    public function getToken($promotion, $appartment) {
        $appartment = Appartment::where('id', $appartment)->first();
        $promotion = Promotion::where('id', $promotion)->first();
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('admin.promotions.payment', compact('token','appartment', 'promotion'));
    }

    public function payment(Request $request) {
        $gateway = new Gateway([
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
    }
}
