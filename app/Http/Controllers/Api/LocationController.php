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
        $radius=$data['params']['radius'];

        $locations=Http::get('https://api.tomtom.com/search/2/search/.json?key=V6jaRxKPvoOCGO0ZXknXlcxxIUKTmAl9&query='. $query .'&radius=' . $radius . '&limit=100');

        $results = [];
        foreach ($locations['results'] as $location) {
            $results[] = [
                'longitude' => $location['position']['lon'],
                'latitude' => $location['position']['lat'],
            ];
        }

        return response()->json($results);
    }
}
