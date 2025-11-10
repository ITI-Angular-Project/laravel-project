<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusUpdated;

class ApplicationController extends Controller
{
    /**
     * Show Employer applications dashboard
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::id());

        $query = Application::query()->with(['job.company']);

        if ($user && $user->hasRole(User::ROLE_EMPLOYER) && $user->company) {
            $companyId = $user->company->id;
            $query->whereHas('job', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            });
        }

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
     * ✅ Normal Apply (Button press)
     */
    public function apply(Job $job)
    {
        $user = User::findOrFail(Auth::id());

        if (!$user) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login first to apply!']);
            }
            return redirect()->route('login')->with('error', 'Please login first to apply!');
        }

        // ✅ تحقق إذا كان المستخدم قد قدم مسبقاً
        if ($this->alreadyApplied($user->id, $job->id)) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'You are already applied, wait for approval.']);
            }
            return redirect()->back()
                ->with('info', 'You are already applied, wait for approval.');
        }

        // ✅ تحقق من اكتمال البيانات
        if (!$user->name || !$user->phone || !$user->resume_path) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please complete your profile before applying.']);
            }
            return redirect()->route('apply.complete-profile', $job->id)
                ->with('warning', 'Please complete your profile before applying.');
        }

        // ✅ إنشاء الطلب الجديد
        $this->createApplication($user, $job);

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Your application has been submitted successfully!']);
        }
        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }


    /**
     * ✅ Display complete profile form if missing required data
     */
    public function completeProfile(Job $job)
    {
        return view('pages.main.complete-profile', compact('job'));
    }


    /**
     * ✅ Handle submit profile + apply
     */
    public function submitProfile(Request $request, Job $job)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'phone' => 'required|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // ✅ تحديث البيانات
        $user->phone = $request->phone;
        $user->save();

        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes');
            $user->resume_path = $path;
            $user->save();
        }

        // ✅ تحقق إذا كان مقدم بالفعل
        if ($this->alreadyApplied($user->id, $job->id)) {
            return redirect()->route('job.details', $job->id)
                ->with('info', 'You are already applied, wait for approval.');
        }

        // ✅ إنشاء التقديم
        $this->createApplication($user, $job);

        return redirect()->route('job.details', $job->id)
            ->with('success', 'Application completed successfully!');
    }


    /**
     * Helper: Check duplicate application
     */
    private function alreadyApplied($userId, $jobId): bool
    {
        return Application::where('candidate_id', $userId)
            ->where('job_id', $jobId)
            ->exists();
    }


    /**
     * Helper: Create Application
     */
    private function createApplication(User $user, Job $job)
    {
        Application::create([
            'job_id' => $job->id,
            'candidate_id' => $user->id,
            'applicant_name' => $user->name,
            'applicant_email' => $user->email,
            'applicant_phone' => $user->phone,
            'resume_path' => $user->resume_path,
            'status' => 'submitted',
        ]);
    }


    public function show(Application $application)
    {
        $application->load(['job.company']);
        return view('pages.dashboard.applications.applications-show', compact('application'));
    }


    public function update(Request $request, Application $application)
    {
        $request->validate([
            'action' => 'required|in:accept,decline,reset'
        ]);

        $status = match ($request->action) {
            'accept' => 'accepted',
            'decline' => 'rejected',
            'reset' => 'pending',
        };

        $application->update(['status' => $status]);

        // Send notification to the candidate
        $candidate = $application->candidate ?? $application->user ?? null;
        if ($candidate) {
            $candidate->notify(new ApplicationStatusUpdated($application));
        }

        return back()->with('success', 'Application status updated to ' . $status . '.');
    }


    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('success', 'Application deleted.');
    }
}
