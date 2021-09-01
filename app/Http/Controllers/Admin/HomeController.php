<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Appartment;

class HomeController extends Controller
{
    public function index() {
        $appartments = Appartment::where('user_id',Auth::user()->id)->get();

        return view('admin.appartments.index', compact('appartments'));
    }
}
