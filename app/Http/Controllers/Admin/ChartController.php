<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Chart;
use App\View;
use App\Appartment;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get request
        $data = $request->all();
        $newData = [];
        foreach ($data as $key => $item) {
            $newData[] = $key;
        }
        
        // Get appartments
        $appartments = Appartment::where('user_id', Auth::user()->id)->get();

        // Get users grouped by age
        if ($newData[0] == 1) {

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', date_create('Y-m-d') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        } else if ($newData[0] == 2) {

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', date_create('Y-m') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        } else if ($newData[0] == 3) {

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', date_create('Y') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        }

        // Empty arrays
        $appartmentId = [];
        $groupKey = [];
        $newGroups = [];
        $filterGroups = [];
        $finalGroups = [];

        // Filter groups array
        foreach ($appartments as $appartment) {
            $appartmentId[] = $appartment->id;
        }
        foreach ($groups as $key => $group) {
            $groupKey[] = $key;
        }
        $newGroups = array_intersect($appartmentId, $groupKey);
        foreach ($groups as $key => $group) {
            if (in_array($key, $newGroups)) {
                $filterGroups[$key] = $group;
            }
        }
        foreach ($appartments as $appartment) {
            foreach ($filterGroups as $key => $filterGroup) {
                if ($appartment->id == $key) {
                    $finalGroups[substr($appartment->title, 0, 30) . '...'] = $filterGroup;
                }
            }
        }

        // Generate random colours for the groups
        for ($i = 0; $i <= count($finalGroups); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        // Prepare the data for returning with the view
        $chart = new Chart;

        $chart->labels = (array_keys($finalGroups));
        $chart->dataset = (array_values($finalGroups));
        $chart->colours = $colours;

        return view('charts.index', compact('chart'));
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
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
