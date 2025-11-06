@extends('layouts.dashboard.app')

@section('content')
<div class="container mx-auto py-8">

    {{-- 🔙 Back Button --}}
    <div class="mb-6">
        <x-ui.button href="{{ route('dashboard.jobs.index') }}" variant="secondary" size="sm">← Back to My Jobs</x-ui.button>
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
        <div class="flex flex-col sm:flex-row gap-3 mt-12">
            <x-ui.button href="{{ route('dashboard.jobs.edit', $job->id) }}">Edit Job</x-ui.button>
            <form action="{{ route('dashboard.jobs.destroy', $job->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?');">
                @csrf
                @method('DELETE')
                <x-ui.button type="submit" variant="danger">Delete Job</x-ui.button>
            </form>
        </div>

    </div>
</div>
@endsection
