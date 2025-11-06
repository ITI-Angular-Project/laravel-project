<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use App\Models\Company;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvedJobsQuery = Job::with(['company:id,name,location,logo_path', 'category:id,name'])
            ->where('status', 'approved');

        $featuredJobs = (clone $approvedJobsQuery)
            ->withCount('applications')
            ->orderByDesc('applications_count')
            ->take(5)
            ->get();

        if ($featuredJobs->count() < 5) {
            $fallbackJobs = (clone $approvedJobsQuery)
                ->latest()
                ->take(5 - $featuredJobs->count())
                ->get();

            $featuredJobs = $featuredJobs->merge($fallbackJobs)->unique('id')->take(5)->values();
        }
        $featuredJobs = $featuredJobs->take(5)->values();

        $latestJobs = (clone $approvedJobsQuery)
            ->latest()
            ->take(5)
            ->get()
            ->values();

        $topCategories = Category::withCount(['jobs' => function ($query) {
            $query->where('status', 'approved');
        }])
            ->orderByDesc('jobs_count')
            ->take(8)
            ->get();

        $categoryOptions = Category::orderBy('name')->get(['id', 'name']);

        $stats = [
            'jobs' => (clone $approvedJobsQuery)->count(),
            'companies' => Company::count(),
            'candidates' => User::where('role', User::ROLE_CANDIDATE)->count(),
        ];

        $heroSlides = [
            [
                'title' => 'Find the talent that elevates your vision',
                'subtitle' => 'Tap into a curated network of professionals ready to move your projects forward.',
                'image' => 'about_us/1.jpg',
            ],
            [
                'title' => 'Hire faster with smarter matching',
                'subtitle' => 'Use data-driven workflows to connect with candidates who truly fit your culture.',
                'image' => 'about_us/3.jpg',
            ],
            [
                'title' => 'Grow with confidence in every hire',
                'subtitle' => 'Scale teams globally with streamlined hiring experiences for recruiters and talent.',
                'image' => 'about_us/4.jpg',
            ],
        ];

        return view('pages.main.home', compact(
            'featuredJobs',
            'latestJobs',
            'topCategories',
            'categoryOptions',
            'stats',
            'heroSlides'
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
}
