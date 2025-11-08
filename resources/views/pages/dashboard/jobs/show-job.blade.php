@extends('layouts.main.app')

@section('content')
<div class="container mx-auto py-10 px-4 md:px-0">

    {{-- 🔙 Back Button --}}
    <div class="mb-6">
        <a href="{{ route('jobs') }}" class="text-sm text-amber-600 hover:text-amber-500 font-semibold flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Jobs
        </a>
    </div>

    {{-- 🧾 Job/Application Card --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8 transition-transform hover:scale-[1.01] duration-300">

        {{-- Title & Status --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">{{ $application->job->title ?? $job->title }}</h1>

            @php
                $statusClasses = match ($application->status ?? $job->status) {
                    'approved', 'submitted' => 'bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-100',
                    'pending' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100',
                    default => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100',
                };
            @endphp

            <span class="px-4 py-2 rounded-full font-semibold text-sm {{ $statusClasses }}">
                {{ ucfirst($application->status ?? $job->status) }}
            </span>
        </div>

        {{-- Basic Info Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @php
                $info = [
                    ['label' => 'Company', 'value' => $application->job->company->name ?? $job->company->name ?? 'N/A'],
                    ['label' => 'Category', 'value' => $application->job->category->name ?? $job->category->name ?? 'N/A'],
                    ['label' => 'Work Type', 'value' => str_replace('_', ' ', $application->job->work_type ?? $job->work_type)],
                    ['label' => 'Deadline', 'value' => \Carbon\Carbon::parse($application->job->deadline ?? $job->deadline)->format('Y-m-d')],
                    ['label' => 'Salary Range', 'value' => ($application->job->salary_min ?? $job->salary_min) && ($application->job->salary_max ?? $job->salary_max) ? "$".($application->job->salary_min ?? $job->salary_min)." - $".($application->job->salary_max ?? $job->salary_max) : "Not specified"],
                    ['label' => 'Technologies', 'value' => $application->job->technologies_txt ?? $job->technologies_txt ?? 'Not specified'],
                    ['label' => 'Applicant Name', 'value' => $application->applicant_name ?? 'N/A'],
                    ['label' => 'Applicant Email', 'value' => $application->applicant_email ?? 'N/A'],
                    ['label' => 'Applicant Phone', 'value' => $application->applicant_phone ?? 'N/A'],
                ];
            @endphp

            @foreach($info as $item)
                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition">
                    <h3 class="text-xs text-gray-500 uppercase mb-1">{{ $item['label'] }}</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $item['value'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Job Sections --}}
        <div class="space-y-10">
            @php
                $sections = [
                    ['title' => 'Description', 'content' => $application->job->description ?? $job->description],
                    ['title' => 'Responsibilities', 'content' => $application->job->responsibilities ?? $job->responsibilities],
                    ['title' => 'Qualifications', 'content' => $application->job->qualifications ?? $job->qualifications],
                    ['title' => 'Benefits', 'content' => $application->job->benefits ?? $job->benefits],
                ];
            @endphp

            @foreach($sections as $section)
                @if($section['content'])
                    <section class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">{{ $section['title'] }}</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $section['content'] }}</p>
                    </section>
                @endif
            @endforeach
        </div>

        {{-- Action Buttons (Optional for Admin/Employer) --}}
        @if(auth()->check() && auth()->user()->hasRole(['admin','employer']))
        <div class="flex flex-col sm:flex-row gap-3 mt-12">
            <x-ui.button href="{{ route('dashboard.jobs.edit', $application->job->id ?? $job->id) }}">Edit Job</x-ui.button>

            <x-ui.confirm-modal :action="route('dashboard.jobs.destroy', $application->job->id ?? $job->id)" method="DELETE"
                title="Delete Job"
                :description="__('Deleting this job will remove all associated applications and analytics.')"
                confirm-text="Delete Job" cancel-text="Cancel">
                <x-slot:trigger>
                    <x-ui.button variant="danger">Delete Job</x-ui.button>
                </x-slot:trigger>
                <p>Please confirm you want to permanently remove this job posting.</p>
            </x-ui.confirm-modal>
        </div>
        @endif

    </div>
</div>
@endsection
