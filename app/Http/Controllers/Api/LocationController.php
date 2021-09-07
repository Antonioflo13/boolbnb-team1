<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Async\Pool;


class LocationController extends Controller
{
    public function index(Request $request){
        $data= $request->all();
        $query=$data['params']['query'];
        $radius=$data['params']['radius'];

        $locations=Http::get('https://api.tomtom.com/search/2/search/.json?key=V6jaRxKPvoOCGO0ZXknXlcxxIUKTmAl9&query='. $query .'&radius=' . $radius . '&limit=100');

        $results = [];
        $results[] = [
            'longitude' => $locations['results'][0]['position']['lon'],
            'latitude' => $locations['results'][0]['position']['lat'],
        ];

        return response()->json($results);
    }

    public function distance (Request $request) {

        $data = $request->all();
        $appartments=$data['params']['appartments'];
        $coordinate=$data['params']['coordinate'];
        $radius=$data['params']['radius'];

        $appartmentsInRadius = [];
        
        foreach ($appartments as $appartment) {
            $distance = sqrt(pow($coordinate[0]['latitude'] - $appartment['latitude'],2) + pow($coordinate[0]['longitude'] - $appartment['longitude'],2)) * 100;
            if ($distance <= $radius) {
                $appartmentsInRadius[] = $appartment;
            }
        }

        return response()->json($appartmentsInRadius);
    }
}
