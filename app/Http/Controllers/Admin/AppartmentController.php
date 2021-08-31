<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Add by Andrea
use Illuminate\Support\Facades\Storage; // Add by Andrea
use Illuminate\Support\Facades\Auth; // Add by Andrea
use Illuminate\Support\Facades\Http; // Add by Andrea

use App\Appartment;
use App\Service; // Add by Andrea

class AppartmentController extends Controller
{
    /**
     * Functions and variables
     */
    private $appartmentsValidationArray = [
        'title' => 'required|min:3|max:150',
        'address' => 'required|min:3|max:150',
        'rooms_number' => 'required|numeric|min:1|max:999',
        'bathrooms_number' => 'required|numeric|min:1|max:999',
        'beds_number' => 'required|numeric|min:1|max:999',
        'square_meters' => 'required|numeric|min:1|max:99999',
        'services' => 'nullable|exists:services,id',
        'description' => 'required|min:3|max:1000',
        'visible' => 'required|in:visible,hidden',
        'image' => 'required|image|max:2048'
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
        $appartments = Appartment::all();

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
        $local = Http::get('https://api.tomtom.com/search/2/search/.json?key=V6jaRxKPvoOCGO0ZXknXlcxxIUKTmAl9&query=' . $data['address']);
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
