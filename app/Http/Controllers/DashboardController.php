<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Council;
use App\Models\Report;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahStaff = User::count();
        $jumlahOsis = Council::count();
        $jumlahLaporan = Report::count();
        $reports = Report::with(['council', 'suspect', 'category'])->latest()->limit(6)->get();
        $councils = Council::latest()->limit(4)->get();

        return view('admin.dashboard', compact('jumlahStaff', 'jumlahOsis', 'jumlahLaporan', 'reports', 'councils'));
    }

    public function chartData()
    {
        $month = now()->format('m');
        // $categories = Report::where('category_id')->count();
        $reports = Report::whereMonth('date', $month)->get()->groupBy(function ($report) {
            return \Carbon\Carbon::parse($report['date'])->format('Y-m-d');
        })->toArray();
        $labels = array_keys($reports);
        $data = [];
        foreach ($reports as $report) {
            array_push($data, count($report));
        }
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);

        // dd($reports);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
