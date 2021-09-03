<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LocationController extends Controller
{
    public function index(Request $request){
        $data= $request->all();
        $query=$data['params']['query'];
        $location=Http::get('https://api.tomtom.com/search/2/search/.json?key=V6jaRxKPvoOCGO0ZXknXlcxxIUKTmAl9&query='.$query);
        $longitude=$location['results']['0']['position']['lon'];
        $latitude=$location['results']['0']['position']['lat'];
        


        return response()->json([
            'longitude'=> $longitude,
            'latitude'=> $latitude
        ]);
    }
}
