<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recentJobs = Job::latest()->take(5)->get();

        // رجّع الصفحة ومعاها البيانات
        return view('pages.dashboard.home', compact('recentJobs'));
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

    public function jobs()
    {
        return view('pages.dashboard.jobs');
    }
    public function applications()
    {
        return view('pages.dashboard.applications');
    }
    public function profile()
    {
        return view('pages.dashboard.profile');
    }
}
