<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Http;

use App\Appartment;
use App\Service;

class AppartmentController extends Controller
{
    /**
     * Functions and variables
     */
    private $appartmentsValidationArray = [
        'title' => 'required|min:3|max:150',
        'address' => 'required|min:3|max:255',
        'rooms_number' => 'required|numeric|min:1|max:999',
        'bathrooms_number' => 'required|numeric|min:1|max:999',
        'beds_number' => 'required|numeric|min:1|max:999',
        'square_meters' => 'required|numeric|min:1|max:99999',
        'services' => 'nullable|exists:services,id',
        'description' => 'required|min:3|max:1000',
        'visible' => 'required|in:visible,hidden',
        'image' => 'required|image|max:2048'
    ];
    private $appartmentsValidationArrayImage = [
        'title' => 'required|min:3|max:150',
        'address' => 'required|min:3|max:255',
        'rooms_number' => 'required|numeric|min:1|max:999',
        'bathrooms_number' => 'required|numeric|min:1|max:999',
        'beds_number' => 'required|numeric|min:1|max:999',
        'square_meters' => 'required|numeric|min:1|max:99999',
        'services' => 'nullable|exists:services,id',
        'description' => 'required|min:3|max:1000',
        'visible' => 'required|in:visible,hidden',
        'image' => 'required'
    ];
    private function addSlugInData($data, $title, $title_slug) {
        $slug = Str::slug($data[$title], '-');
        $existingInModel = Appartment::where($title_slug, $slug)->first();
        $counter = 1;

        while ($existingInModel) {
            $slug = Str::slug($data[$title], '-') . '-' . $counter;
            $existingInModel = Appartment::where($title_slug, $slug)->first();
            $counter++;
        }

        $data[$title_slug] = $slug;
        return $data;
    }

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
        $services = Service::all();

        return view('admin.appartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Enhance $data
        $data = $request->all();

        // Validation
        $request->validate($this->appartmentsValidationArray);

        // Add slug
        $data = $this->addSlugInData($data, 'title', 'slug');

        // Change in a boolean value $data['visible']
        if ($data['visible'] === 'visible') {
            $data['visible'] = 1;
        } else {
            $data['visible'] = 0;
        }

        // Add image in Storage
        $data['image'] = Storage::put('appartment_images', $data['image']);

        // Add user_id in $data
        $data['user_id'] = Auth::user()->id;

        // Add longitude and latitude in $data
        $local = Http::get('https://api.tomtom.com/search/2/search/.json?key=ubO6kthk3bpiLfR8uiFmtyF9dnZxYok3&query=' . $data['address']);
        $data['longitude'] = $local['results']['0']['position']['lon'];
        $data['latitude'] = $local['results']['0']['position']['lat'];

        // New Appartment istance
        $appartment = new Appartment();
        $appartment->fill($data);
        $appartment->save();

        // Attach appartment_service
        if (array_key_exists('services', $data)) {
            $appartment->services()->attach($data['services']);
        }

        // Redirect
        return redirect()
            ->route('admin.appartments.show', $appartment->id)
            ->with('message', 'The ' . $appartment->title . ' apartment has been successfully added to your list!');
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
    public function edit(Appartment $appartment)
    {
        $services = Service::all();

        // Add address in $appartment
        // $address = Http::get('https://api.tomtom.com/search/2/search/' . $appartment->latitude . ',' . $appartment->longitude . '.json?key=ubO6kthk3bpiLfR8uiFmtyF9dnZxYok3');
        // $address = $address['results'][0]['address'];
        // if (array_key_exists('streetName', $address)) {
        //     $street_name = $address['streetName'];
        // } else {
        //     $street_name = '';
        // }
        // if (array_key_exists('municipality', $address)) {
        //     $municipalty = $address['municipality'];
        // } else {
        //     $municipalty = '';
        // }
        // if (array_key_exists('countrySecondarySubdivision', $address)) {
        //     $country_secondary_municipalty = $address['countrySecondarySubdivision'];
        // } else {
        //     $country_secondary_municipalty = '';
        // }
        // $address = $street_name . ' ' . $municipalty . ' '  . $country_secondary_municipalty;
        // $appartment->address = $address;

        // Change in a string value $data['visible']
        if ($appartment->visible == 1) {
            $appartment->visible = 'visible';
        } else {
            $appartment->visible = 'hidden';
        }

        return view('admin.appartments.edit', compact('services', 'appartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appartment $appartment)
    {
        // Enhance $data
        $data = $request->all();

        // Validation and add image in Storage
        if (array_key_exists('image', $data)) {
            Storage::delete($appartment->image);
            $request->validate($this->appartmentsValidationArray);
            $data['image'] = Storage::put('appartment_images', $data['image']);
        } else {
            $request->request->add(['image' => $appartment->image]);
            $request->validate($this->appartmentsValidationArrayImage);
            $data = $request->all();
        }

        // Add slug
        if ($appartment->title != $data['title']) {
            $data = $this->addSlugInData($data, 'title', 'slug');
        }

        // Change in a boolean value $data['visible']
        if ($data['visible'] === 'visible') {
            $data['visible'] = 1;
        } else {
            $data['visible'] = 0;
        }

        // Add longitude and latitude in $data
        $local = Http::get('https://api.tomtom.com/search/2/search/.json?key=V6jaRxKPvoOCGO0ZXknXlcxxIUKTmAl9&query=' . $data['address']);
        $data['longitude'] = $local['results']['0']['position']['lon'];
        $data['latitude'] = $local['results']['0']['position']['lat'];

        // Update Appartment
        $appartment->update($data);

        // Attach appartment_service
        if (array_key_exists('services', $data)) {
            $appartment->services()->sync($data['services']);
        } else {
            $appartment->services()->detach();
        }

        // Redirect
        return redirect()
            ->route('admin.appartments.show', $appartment->id)
            ->with('message', 'The ' . $appartment->title . ' apartment has been successfully edited to your list!');
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
      
        return redirect()->route('admin.appartments.index');
    }
}
