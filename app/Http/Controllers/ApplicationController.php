<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::id());

        $query = Application::query()->with(['job.company']);

        // Scope for employer
        if ($user && $user->hasRole(User::ROLE_EMPLOYER) && $user->company) {
            $companyId = $user->company->id;
            $query->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });
        }

        // Filters
        if ($request->filled('search')) {
            $s = $request->string('search');
            $query->where(function ($q) use ($s) {
                $q->where('applicant_name', 'like', "%{$s}%")
                    ->orWhere('applicant_email', 'like', "%{$s}%");
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(10)->withQueryString();

        return view('pages.dashboard.applications.applications', compact('applications'));
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
    public function store(StoreApplicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load(['job.company']);
        return view('pages.dashboard.applications.applications-show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'action' => 'required|in:accept,decline,reset'
        ]);

        $status = match($request->action) {
            'accept' => 'accepted',
            'decline' => 'rejected',
            'reset' => 'pending',
        };

        $application->update(['status' => $status]);
        return back()->with('success', 'Application status updated to '.$status.'.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'Application deleted.');
    }
}
