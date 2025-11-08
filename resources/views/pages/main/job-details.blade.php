@extends('layouts.main.app')

@section('content')
    <div class="container mx-auto py-8">

        {{-- 🔙 Back Button --}}
        <div class="mb-6">
            <a href="{{ route('jobs') }}" class="text-sm text-amber-600 hover:text-amber-500 font-semibold">
                ← Back to Jobs
            </a>
        </div>

        {{-- 🧾 Job Card --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl p-8 border border-gray-200 dark:border-gray-700 transition hover:shadow-2xl">

            {{-- Title --}}
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 tracking-tight mb-6">{{ $job->title }}</h1>

            {{-- Basic Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Company</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $job->company->name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Category</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $job->category->name ?? 'N/A' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Work Type</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ str_replace('_', ' ', $job->work_type) }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Deadline</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Salary</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        @if ($job->salary_min && $job->salary_max)
                            ${{ $job->salary_min }} - ${{ $job->salary_max }}
                        @else
                            Not specified
                        @endif
                    </p>
                </div>

                <div>
                    <h3 class="text-xs text-gray-500 uppercase mb-1">Technologies</h3>
                    <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ $job->technologies_txt ?? 'Not specified' }}
                    </p>
                </div>
            </div>

            {{-- Job Sections --}}
            <div class="space-y-8">
                @if ($job->description)
                    <section>
                        <h2 class="text-xl font-semibold mb-2">Description</h2>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $job->description }}
                        </p>
                    </section>
                @endif

                @if ($job->responsibilities)
                    <section>
                        <h2 class="text-xl font-semibold mb-2">Responsibilities</h2>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                            {{ $job->responsibilities }}
                        </p>
                    </section>
                @endif

                @if ($job->qualifications)
                    <section>
                        <h2 class="text-xl font-semibold mb-2">Qualifications</h2>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                            {{ $job->qualifications }}
                        </p>
                    </section>
                @endif

                @if ($job->benefits)
                    <section>
                        <h2 class="text-xl font-semibold mb-2">Benefits</h2>
                        <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                            {{ $job->benefits }}
                        </p>
                    </section>
                @endif
            </div>

            {{-- Apply Button --}}
            @auth
                <form action="{{ route('apply.job', $job->id) }}" method="POST">
                    @csrf
                    <button
                        class="mt-6 inline-flex items-center rounded-xl bg-amber-500 px-6 py-3
                       font-semibold text-slate-950 hover:bg-amber-400">
                        Apply Now
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="mt-6 inline-flex items-center rounded-xl bg-amber-500 px-6 py-3
              font-semibold text-slate-950 hover:bg-amber-400">
                    Login to Apply
                </a>
            @endauth


        </div>
    </div>
@endsection
