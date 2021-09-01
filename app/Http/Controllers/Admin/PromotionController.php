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
}
