<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use DateTime;
use DateTimeZone;
use App\Chart;
use App\View;
use App\Appartment;

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

        // Define title
        $title = '';

        // Get localtime
        $localtime = new DateTime("now", new DateTimeZone('Europe/Rome'));

        // Get users grouped by age
        if ($newData[0] == 1) {
            $title = 'Today';
            $date = $localtime->format('d F Y');

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', $localtime->format('Y-m-d') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        } else if ($newData[0] == 2) {
            $title = 'This month';
            $date = $localtime->format('F Y');

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', $localtime->format('Y-m-') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        } else if ($newData[0] == 3) {
            $title = 'This year';
            $date = $localtime->format('Y');

            $groups = DB::table('views')
                ->select('appartment_id', DB::raw('count(*) as total'))
                ->where('created_at', 'like', $localtime->format('Y-') . '%')
                ->groupBy('appartment_id')
                ->pluck('total', 'appartment_id')->all();

        }

        // Empty arrays
        $appartmentId = [];
        $groupKey = [];
        $newGroups = [];
        $filterGroups = [];
        $finalGroups = [];
        $finalComplete = [];
        $finalGroupsComplete = [];

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
        foreach ($appartments as $count => $appartment) {
            foreach ($filterGroups as $key => $filterGroup) {
                if ($appartment->id == $key) {
                    $finalGroups[($count + 1) . ') ' . substr($appartment->title, 0, 6) . '...'] = $filterGroup;
                    $finalGroupsComplete[($count + 1) . ') ' . $appartment->title] = $filterGroup;
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
        $chart->info = (array_keys($finalGroupsComplete));
        $chart->colours = $colours;

        return view('charts.index', compact('chart', 'title', 'date'));
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
