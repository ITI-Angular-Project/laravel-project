@extends('layouts.dashboard.app')

@section('content')
    <div class="container mx-auto ">

        {{-- 🔹 Title + Filters + New Job --}}
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">My Jobs</h2>
                <x-ui.button href="{{ route('dashboard.jobs.create') }}" size="md">New Job</x-ui.button>
            </div>

            <x-ui.filters :action="route('dashboard.jobs.index')" :filters="[
                ['type' => 'text', 'name' => 'search', 'label' => 'Keywords', 'placeholder' => 'Title or description'],
                ['type' => 'text', 'name' => 'location', 'label' => 'Location'],
                ['type' => 'select', 'name' => 'status', 'label' => 'Status', 'options' => ['' => 'All', 'approved' => 'Approved', 'pending' => 'Pending', 'rejected' => 'Rejected']],
                ['type' => 'select', 'name' => 'date_posted', 'label' => 'Date Posted', 'options' => ['' => 'Any time', '24h' => 'Last 24h', '7d' => 'Last 7d', '30d' => 'Last 30d']],
            ]" />
        </div>

        {{-- ✅ Success message --}}
        @if (session('success'))
            <div
                class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20
                border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200
                px-4 py-3 rounded-xl shadow-lg animate-in slide-in-from-top duration-300 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586
                                                                 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($jobs->isEmpty())
            <div class="text-center text-gray-500 dark:text-gray-400 mt-12">
                <p class="text-lg">No jobs found yet. Click <span class="font-semibold">“Add New Job”</span> to post your
                    first one!</p>
            </div>
        @else
            @php($columns = [
                ['key' => 'title', 'label' => 'Title', 'tdClass' => 'text-gray-800 dark:text-gray-100 font-medium'],
                ['key' => 'work_type', 'label' => 'Work Type', 'format' => function($row, $v){ return e(str_replace('_',' ',$v)); }],
                ['key' => 'salary', 'label' => 'Salary', 'format' => function($row){
                    if($row->salary_min && $row->salary_max){ return '$'.$row->salary_min.' - $'.$row->salary_max; }
                    return '<span class="text-gray-400">Not specified</span>';
                }],
                ['key' => 'deadline', 'label' => 'Deadline', 'format' => function($row){ return e(\Carbon\Carbon::parse($row->deadline)->format('Y-m-d')); }],
                ['key' => 'status', 'label' => 'Status', 'format' => function($row){
                    $classes = 'px-3 py-1 rounded-full text-xs font-semibold ';
                    if($row->status==='approved'){ $classes.='bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100'; }
                    elseif($row->status==='pending'){ $classes.='bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100'; }
                    else { $classes.='bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100'; }
                    return '<span class="'.$classes.'">'.e(ucfirst($row->status)).'</span>';
                }],
            ])

            <x-ui.data-table :columns="$columns" :rows="$jobs" :paginator="$jobs" />
        @endif

    </div>
@endsection
