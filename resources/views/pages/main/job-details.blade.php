@extends('layouts.main.app')

@section('content')
<div class="container mx-auto py-10 px-4 md:px-0 max-w-4xl">

    {{-- 🔙 Back Button --}}
    <div class="mb-6">
        <a href="{{ route('jobs') }}" class="text-sm text-amber-600 hover:text-amber-500 font-semibold flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Jobs
        </a>
    </div>

    {{-- 🧾 Job Card --}}
    <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8 transition-transform hover:scale-[1.01] duration-300">

        {{-- Title --}}
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-100 tracking-tight mb-6">
            {{ $job->title }}
        </h1>

        {{-- Basic Info Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @php
                $info = [
                    ['label' => 'Company', 'value' => $job->company->name ?? 'N/A'],
                    ['label' => 'Category', 'value' => $job->category->name ?? 'N/A'],
                    ['label' => 'Work Type', 'value' => str_replace('_', ' ', $job->work_type)],
                    ['label' => 'Deadline', 'value' => \Carbon\Carbon::parse($job->deadline)->format('Y-m-d')],
                    ['label' => 'Salary', 'value' => $job->salary_min && $job->salary_max ? "$".$job->salary_min." - $".$job->salary_max : "Not specified"],
                    ['label' => 'Technologies', 'value' => $job->technologies_txt ?? 'Not specified'],
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
                    ['title' => 'Description', 'content' => $job->description],
                    ['title' => 'Responsibilities', 'content' => $job->responsibilities],
                    ['title' => 'Qualifications', 'content' => $job->qualifications],
                    ['title' => 'Benefits', 'content' => $job->benefits],
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

        {{-- Apply Button --}}
        <div class="mt-8 flex justify-center">
            @auth
                <form action="{{ route('apply.job', $job->id) }}" method="POST" class="w-full md:w-auto">
                    @csrf
                    <button type="submit"
                        class="w-full md:w-auto inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                        hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-900 transition">
                        Apply Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="w-full md:w-auto inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                    hover:bg-amber-400 transition">
                    Login to Apply
                </a>
            @endauth
        </div>

    </div>
</div>
@endsection
