<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Promotion;

class PromotionController extends Controller
{
    public function index() {
        $promotions = Promotion::all();

        return view('admin.promotion.index', compact('promotions'));
    }
}
