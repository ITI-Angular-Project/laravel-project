<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\JobView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        // Base queries
        $jobQuery          = Job::query();
        $applicationQuery  = Application::query();
        $viewsBaseQuery    = JobView::query();

        // Role checks
        $isAdmin    = $user && $user->hasRole(User::ROLE_ADMIN);
        $isEmployer = $user && $user->hasRole(User::ROLE_EMPLOYER) && $user->company;

        // Scope ONLY for employers. Admins see all.
        if ($isEmployer) {
            $companyId = $user->company_id ?? $user->company->id;

            $jobQuery->where('company_id', $companyId);

            $applicationQuery->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });

            $viewsBaseQuery->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });
        } elseif (!$isAdmin) {
            // Anyone else: block or return empty. Choose one:
            abort(403); // unauthorized
            // or: $jobQuery->whereRaw('1=0'); $applicationQuery->whereRaw('1=0'); $viewsBaseQuery->whereRaw('1=0');
        }

        // Time helpers
        $now           = now();
        $startOfMonth  = $now->copy()->startOfMonth();
        $days          = 14;
        $from          = $now->copy()->subDays($days - 1)->startOfDay();

        // Core stats
        $totalJobs = (clone $jobQuery)->count();
        $acceptedJobs = (clone $jobQuery)->where('status', 'approved')->count();

        $applicationsThisMonth = (clone $applicationQuery)
            ->where('created_at', '>=', $startOfMonth)
            ->count();

        $acceptedJobsThisMonth = (clone $jobQuery)
            ->where('status', 'approved')
            ->where('created_at', '>=', $startOfMonth)
            ->count();

        // Recent jobs list
        $recentJobs = (clone $jobQuery)
            ->withCount('applications')
            ->latest()
            ->take(7)
            ->get();

        // Views chart (last 14 days)
        $viewsByDay = $viewsBaseQuery
            ->with('job:id,title')
            ->where('created_at', '>=', $from)
            ->get()
            ->groupBy(fn($v) => Carbon::parse($v->created_at)->format('Y-m-d'));

        $viewsDaily = [];
        $viewsBreakdown = [];
        for ($i = 0; $i < $days; $i++) {
            $date = $now->copy()->subDays($days - 1 - $i)->format('Y-m-d');
            $dayViews = $viewsByDay[$date] ?? collect();
            $viewsDaily[$date] = $dayViews->count();

            $viewsBreakdown[$date] = $dayViews->isNotEmpty()
                ? $dayViews
                    ->groupBy(fn($view) => optional($view->job)->title ?? 'Unknown Job')
                    ->map(fn($items) => $items->count())
                    ->sortDesc()
                    ->take(5)
                    ->map(fn($count, $title) => ['title' => $title, 'count' => $count])
                    ->values()
                    ->toArray()
                : [];
        }

        $viewsChartData   = array_values($viewsDaily);
        $viewsChartLabels = array_map(fn ($date) => Carbon::parse($date)->format('D'), array_keys($viewsDaily));
        $viewsChartTotal  = array_sum($viewsDaily);
        $viewsChartDates  = array_keys($viewsDaily);

        return view('pages.dashboard.home', [
            'recentJobs'             => $recentJobs,
            'totalJobs'              => $totalJobs,
            'acceptedJobs'           => $acceptedJobs,
            'applicationsThisMonth'  => $applicationsThisMonth,
            'acceptedJobsThisMonth'  => $acceptedJobsThisMonth,
            'viewsDaily'             => $viewsDaily,
            'viewsChartData'         => $viewsChartData,
            'viewsChartLabels'       => $viewsChartLabels,
            'viewsChartTotal'        => $viewsChartTotal,
            'viewsChartDates'        => $viewsChartDates,
            'viewsChartBreakdown'    => $viewsBreakdown,
        ]);
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
