<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use App\Promotion;
use App\Appartment;
use App\User;

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

    public function payment(Request $request, $promotion, $appartment) {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $promotion = Promotion::where('id', $promotion)->first();
        $user = User::where('id',Auth::user()->id)->first();
        $amount = $promotion->price;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $user->name,
                'lastName' => $user->surname,
                'email' => $user->emal
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        
        $appartment = Appartment::where('id', $appartment)->first();

        $startpromotion = date("Y-m-d H:i:s");
        $endpromotion = date("Y-m-d H:i:s", strtotime($promotion->hours . 'hours'));

        if ($result->success) {
            $transaction = $result->transaction;

            $appartment->promotions()->detach($promotion->id, array('start_promotion' => $startpromotion,'end_promotion' => $endpromotion));

            $appartment->promotions()->attach($promotion->id, array('start_promotion' => $startpromotion,'end_promotion' => $endpromotion));
            

            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
            return redirect()->route('admin.appartments.show', $appartment->id)->with('success_message','Transaction succesfull.');
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
