<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * عرض كل الوظائف الخاصة بالمستخدم الحالي (صاحب الشركة)
     */
    public function index(Request $request)
    {
        $user = Auth::user();


        $jobs = Job::orderBy('created_at', 'desc')->paginate(5);
        // if ($user->company) {
        //     // عرض الوظائف التابعة لشركة المستخدم
        //     $jobs = Job::where('company_id', $user->company->id)
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(5);
        // } else {
        //     $jobs = collect();
        // }
        $jobsQuery = Job::query();
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

        // ترتيب وعمل paginate
        $jobs = $jobsQuery->orderBy('created_at', 'desc')->paginate(5)->withQueryString();


        return view('pages.dashboard.jobs.jobs', compact('jobs'));
    }

    /**
     * عرض صفحة إنشاء وظيفة جديدة
     */
    public function create()
    {
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

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    /**
     * عرض تفاصيل وظيفة معينة
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        if (!$user->company || $job->company_id !== $user->company->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('pages.dashboard.jobs.show-job', compact('job'));
    }

    /**
     * عرض صفحة تعديل وظيفة
     */
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        // تأكد إن المستخدم صاحب الشركة نفسها
        if (!$user->company || $job->company_id !== $user->company->id) {
            abort(403, 'Unauthorized action.');
        }

        // جلب الشركات والفئات لو محتاجين في الفورم
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

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
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

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
