<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Appartment;
use App\AppartmentPromotion;

class AppartmentController extends Controller
{   
    public function index() {
        $appartments = Appartment::orderBy('id', 'ASC')->with(['services', 'promotions'])->get();
       
        return response()->json($appartments);
    }

    public function show($slug) {
        $appartment = Appartment::where('slug',$slug)->with('services','promotions')->first();

        return response()->json($appartment);
    }

    public function promotion() {
        $appartmentpromotion = AppartmentPromotion::all();
        $currentDate = date("Y-m-d H:i:s");
        $appartments = [];

        foreach ($appartmentpromotion as $item) {
            if ($item->end_promotion >= $currentDate) {
                $appartments[] = Appartment::where('id', $item->appartment_id)->first();
            }
        }

        return response()->json($appartments);
    }
}
