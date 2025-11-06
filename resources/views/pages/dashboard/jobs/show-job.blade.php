@extends('layouts.dashboard.app')

@section('content')
<div class="container mx-auto py-8">

    {{-- 🔙 Back Button --}}
    <div class="mb-6">
        <a href="{{ route('dashboard.jobs.index') }}"
            class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to My Jobs
        </a>
    </div>

    {{-- 🧾 Job Card --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-8 border border-gray-200 dark:border-gray-700 transition hover:shadow-2xl">

        {{-- Title & Status --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">{{ $job->title }}</h1>
            <span
                class="px-4 py-2 rounded-full font-semibold text-sm
                @if($job->status == 'approved') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100
                @elseif($job->status == 'pending') bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100
                @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 @endif">
                {{ ucfirst($job->status) }}
            </span>
        </div>

        {{-- Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Company</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $job->company->name ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Category</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $job->category->name ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Work Type</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ str_replace('_', ' ', $job->work_type) }}</p>
            </div>
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Deadline</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}</p>
            </div>
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Salary Range</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    @if ($job->salary_min && $job->salary_max)
                        ${{ $job->salary_min }} - ${{ $job->salary_max }}
                    @else
                        Not specified
                    @endif
                </p>
            </div>
            <div>
                <h3 class="text-sm text-gray-500 uppercase mb-1">Technologies</h3>
                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $job->technologies_txt ?? 'Not specified' }}</p>
            </div>
        </div>

        {{-- Job Sections --}}
        <div class="space-y-8">
            @if ($job->description)
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Description</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $job->description }}</p>
                </div>
            @endif
            @if ($job->responsibilities)
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Responsibilities</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $job->responsibilities }}</p>
                </div>
            @endif
            @if ($job->qualifications)
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Qualifications</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $job->qualifications }}</p>
                </div>
            @endif
            @if ($job->benefits)
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Benefits</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $job->benefits }}</p>
                </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 mt-12">
            <a href="{{ route('dashboard.jobs.edit', $job->id) }}"
               class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h6M4 7h6m1 6h8m-8 4h6" />
                </svg>
                Edit Job
            </a>

            <form action="{{ route('dashboard.jobs.destroy', $job->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this job?');"
                        class="flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a2 2 0 00-2 2v0a2 2 0 002 2h4a2 2 0 002-2v0a2 2 0 00-2-2m-4 0v0" />
                    </svg>
                    Delete Job
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
