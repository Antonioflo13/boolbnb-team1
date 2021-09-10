<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\View;

class ViewController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        $view = new View();

        $view->fill($data);

        $view->save();

        return response()->json($data);
    }
}
