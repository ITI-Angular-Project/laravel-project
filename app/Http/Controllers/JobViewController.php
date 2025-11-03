<?php

namespace App\Http\Controllers;

use App\Models\JobView;
use App\Http\Requests\StoreJobViewRequest;
use App\Http\Requests\UpdateJobViewRequest;

class JobViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreJobViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobView $jobView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobView $jobView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobViewRequest $request, JobView $jobView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobView $jobView)
    {
        //
    }
}
