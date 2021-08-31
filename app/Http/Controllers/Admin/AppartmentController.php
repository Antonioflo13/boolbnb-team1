<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


use App\Appartment;

class AppartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appartments = Appartment::where('user_id',Auth::user()->id)->get();

        return view('admin.appartments.index', compact('appartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appartment $appartment)
    {
        $latitude = $appartment->latitude;
        $longitude = $appartment->longitude;
        $location = Http::get("https://api.tomtom.com/search/2/search/.`${latitude}`, `{$longitude}`.json?&ext=.json&key=ubO6kthk3bpiLfR8uiFmtyF9dnZxYok3");
        $city = $location['results'][0]['address']['municipality'];
        return view('admin.appartments.show',compact('appartment','location','city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appartment $appartment)
    {
        $appartment->delete();
        return redirect()->route('admin.appartment.index');
    }
}
