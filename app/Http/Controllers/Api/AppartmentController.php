<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Appartment;
use App\AppartmentPromotion;

class AppartmentController extends Controller
{   
    public function index() {
        $appartments = Appartment::where('visible', 1)->with(['services', 'promotions'])->get();
       
        return response()->json($appartments);
    }

    public function paginateappartments(Request $request) {
        $data = $request->all();
        $appartments = Appartment::where('visible', 1)->with(['services', 'promotions'])->paginate($data['number']);
       
        return response()->json($appartments);
    }

    public function show($slug) {
        $appartment = Appartment::where('slug',$slug)->with('services','promotions')->first();

        return response()->json($appartment);
    }

    public function promotion() {
        $appartmentpromotion = AppartmentPromotion::where('visible', 1);
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
