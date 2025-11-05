<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display dashboard with summary data.

    public function index()
    {
        $user = auth()->user();

        // آخر 5 وظائف منشورة للشركة
        $recentJobs = Job::where('company_id', $user->company->id ?? 0)
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        // آخر أسبوع
        $oneWeekAgo = Carbon::now()->subWeek();

        // 1️⃣ New Applications: الابلكيشنز الجديدة آخر أسبوع
        $newApplications = Application::whereHas('job', function ($q) use ($user) {
            $q->where('company_id', $user->company->id ?? 0);
        })
            ->where('created_at', '>=', $oneWeekAgo)
            ->count();

        // 2️⃣ Closed Jobs: الوظائف المغلقة (rejected)
        $closedJobs = Job::where('company_id', $user->company->id ?? 0)
            ->where('status', 'rejected')
            ->count();

        // 3️⃣ Total Applications: كل الابلكيشنز
        $totalApplications = Application::whereHas('job', function ($q) use ($user) {
            $q->where('company_id', $user->company->id ?? 0);
        })
            ->count();

        return view('pages.dashboard.home', compact(
            'recentJobs',
            'newApplications',
            'closedJobs',
            'totalApplications'
        ));
    }
*/


    public function index()
    {
        // آخر 5 وظائف منشورة
        $recentJobs = Job::withCount('applications')
            ->latest()
            ->take(7)
            ->get();

        // آخر أسبوع
        $oneWeekAgo = Carbon::now()->subWeek();

        // 1️⃣ New Applications: الابلكيشنز الجديدة آخر أسبوع
        $newApplications = Application::where('created_at', '>=', $oneWeekAgo)->count();

        // 2️⃣ Closed Jobs: الوظائف المغلقة (rejected)
        $closedJobs = Job::where('status', 'rejected')->count();

        // 3️⃣ Total Applications: كل الابلكيشنز
        $totalApplications = Application::count();

        return view('pages.dashboard.home', compact(
            'recentJobs',
            'newApplications',
            'closedJobs',
            'totalApplications'
        ));
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
