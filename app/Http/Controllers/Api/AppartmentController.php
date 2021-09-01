<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Appartment;

class AppartmentController extends Controller
{   
    public function index() {
        $appartments = Appartment::all();
        return response()->json($appartments);
    }

    public function show($slug) {
        $appartment = Appartment::where('slug',$slug)->with('services')->first();

        return response()->json($appartment);
    }
}
