<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Promotion;

class PromotionController extends Controller
{
    public function index() {
        $promotions = Promotion::all();

        return view('admin.promotions.index', compact('promotions'));
    }

    public function payment() {
        $promotions = Promotion::all();

        return view('admin.promotions.payment', compact('promotions'));
    }
}
