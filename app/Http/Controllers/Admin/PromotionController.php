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

    public function payment() {
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('admin.promotions.payment', compact('token'));
    }
}
