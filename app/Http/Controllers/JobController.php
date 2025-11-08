<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Company;
use App\Models\User;
use App\Notifications\JobsStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * عرض الوظائف في الموقع الرئيسي
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $jobs = Job::where('status', 'approved')->latest();

        if ($request->category_id) {
            $jobs->where('category_id', $request->category_id);
        }

        if ($request->keyword) {
            $jobs->where('title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->location) {
            $jobs->whereHas('company', function ($query) use ($request) {
                $query->where('location', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('work_type')) {
            $jobs->where('work_type', $request->work_type);
        }

        if ($request->salary_range) {
            if (str_contains($request->salary_range, '+')) {
                $min = rtrim($request->salary_range, '+');
                $jobs->where('salary_min', '>=', $min);
            } elseif (str_contains($request->salary_range, '-')) {
                [$min, $max] = explode('-', $request->salary_range);
                $jobs->whereBetween('salary_min', [$min, $max]);
            }
        }

        // Filter by date posted
        if ($request->filled('date_posted')) {
            $now = now();

            switch ($request->date_posted) {
                case '24h':
                    $jobs->where('created_at', '>=', $now->subDay());
                    break;
                case '7d':
                    $jobs->where('created_at', '>=', $now->subDays(7));
                    break;
                case '30d':
                    $jobs->where('created_at', '>=', $now->subDays(30));
                    break;
            }
        }

        $jobs = $jobs->paginate(12)->withQueryString();

        $minSalary = Job::min('salary_min');
        $maxSalary = Job::max('salary_max');

        $rangeStep = ($maxSalary - $minSalary) / 4;
        $salaryRanges = [];
        for ($i = 0; $i < 4; $i++) {
            $start = round($minSalary + $rangeStep * $i);
            $end = round($minSalary + $rangeStep * ($i + 1));
            $salaryRanges[] = "{$start}-{$end}";
        }
        $salaryRanges[] = round($maxSalary) . '+';

        return view('pages.main.jobs', compact('jobs', 'categories', 'salaryRanges'));
    }

    /**
     * عرض كل الوظائف الخاصة بالمستخدم الحالي (صاحب الشركة)
     */
    public function dashboardIndex(Request $request)
    {
        $user = User::find(Auth::id());

        if ($user->hasRole('admin')) {
            $jobsQuery = Job::query();
        } else {
            if (!$user->company) {
                return redirect(route('dashboard.home'))
                    ->with('error', 'You must create a company profile to view jobs.');
            }
            $jobsQuery = Job::where('company_id', $user->company?->id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $jobsQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $jobsQuery->where('status', $request->status);
        }

        $jobs = $jobsQuery->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return view('pages.dashboard.jobs.jobs', compact('jobs'));
    }

    /**
     * عرض صفحة إنشاء وظيفة جديدة
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        $categories = Category::all();
        return view('pages.dashboard.jobs.create-job', compact('categories'));
    }

    /**
     * تخزين وظيفة جديدة في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:180',
            'description' => 'required',
            'work_type' => 'required|in:remote,on_site,hybrid',
            'deadline' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $company = $user->company;

        if (!$company) {
            return back()->withErrors(['error' => 'You must create a company profile before posting jobs.']);
        }

        Job::create([
            'company_id' => $company->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'responsibilities' => $request->responsibilities,
            'qualifications' => $request->qualifications,
            'benefits' => $request->benefits,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'work_type' => $request->work_type,
            'technologies_txt' => $request->technologies_txt,
            'deadline' => $request->deadline,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard.jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * عرض تفاصيل وظيفة معينة
     */
    public function show($id)
    {
        $job = Job::with(['company', 'category'])->findOrFail($id);
        return view('pages.dashboard.jobs.show-job', compact('job'));
    }

    /**
     * عرض صفحة تعديل وظيفة
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $this->authorize('update', $job);

        $user = Auth::user();

        if (!$user->company || $job->company_id !== $user->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $companies = Company::all();
        $categories = Category::all();

        return view('pages.dashboard.jobs.edit-job', compact('job', 'companies', 'categories'));
    }

    /**
     * تحديث بيانات وظيفة موجودة
     */
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        if (!$user->company || $job->company_id !== $user->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|max:180',
            'description' => 'required',
            'work_type' => 'required|in:remote,on_site,hybrid',
            'deadline' => 'required|date',
        ]);

        $job->update($request->only([
            'title',
            'description',
            'responsibilities',
            'qualifications',
            'benefits',
            'salary_min',
            'salary_max',
            'work_type',
            'technologies_txt',
            'deadline',
            'category_id',
        ]));

        return redirect()->route('dashboard.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function approve(Job $job)
    {
        $user = User::findOrFail(Auth::id());

        if (!$user || !$user->hasRole(User::ROLE_ADMIN)) {
            abort(403, 'Unauthorized action.');
        }

        if ($job->status !== 'approved') {
            $job->update(['status' => 'approved']);
            User::findOrFail($job->company->employer_id)->notify(new JobsStatusUpdated($job));
        }

        return back()->with('success', 'Job approved successfully.');
    }

    public function reject(Job $job)
    {
        $user = User::findOrFail(Auth::id());

        if (!$user || !$user->hasRole(User::ROLE_ADMIN)) {
            abort(403, 'Unauthorized action.');
        }

        if ($job->status !== 'rejected') {
            $job->update(['status' => 'rejected']);
            User::findOrFail($job->company->employer_id)->notify(new JobsStatusUpdated($job));
        }

        return back()->with('success', 'Job rejected.');
    }

    /**
     * حذف وظيفة
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        if (!$user->company || $job->company_id !== $user->company->id) {
            abort(403, 'Unauthorized action.');
        }

        $job->delete();

        return redirect()->route('dashboard.jobs.index')->with('success', 'Job deleted successfully!');
    }
    public function details($id)
    {
        $job = Job::with(['company', 'category'])->findOrFail($id);

        return view('pages.main.job-details', compact('job'));
    }

}
