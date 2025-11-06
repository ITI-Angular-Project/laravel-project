@extends('layouts.dashboard.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Top metrics like the reference UI --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v8a2 2 0 002 2h10a2 2 0 002-2v-8"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalJobs }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Posted Job</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $acceptedJobs }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Accepted Jobs</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($applicationsThisMonth) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Applications this month</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h6"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $acceptedJobsThisMonth }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Accepted this month</div>
                    </div>
                </div>
            </div>

            {{-- Main panels: Job Views chart + Posted Jobs list --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                {{-- Job Views (simple SVG chart) --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Job Views</h3>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Last 14 days</div>
                    </div>

                    <div class="rounded-xl border border-gray-100 dark:border-gray-700 p-4">
                        @php($max = max($viewsDaily ?: [0]))
                        <div class="h-48 flex items-end gap-2">
                            @foreach($viewsDaily as $date => $count)
                                @php($h = $max > 0 ? intval(($count/$max)*100) : 0)
                                <div class="flex-1 group">
                                    <div class="mx-auto w-full rounded-t bg-emerald-500/70 group-hover:bg-emerald-600 transition-all" style="height: {{ max($h,4) }}%"></div>
                                    <div class="mt-1 text-[10px] text-gray-500 dark:text-gray-400 text-center">{{ \Carbon\Carbon::parse($date)->format('D') }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">Total views: {{ array_sum($viewsDaily) }}</div>
                    </div>
                </div>

                {{-- Posted Jobs --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Posted Jobs</h3>
                    <div class="space-y-2">
                        @forelse($recentJobs as $job)
                            <div class="flex items-start gap-3 p-2 rounded-xl hover:bg-emerald-50 dark:hover:bg-gray-800 transition">
                                <div class="h-9 w-9 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-700 dark:text-emerald-300">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ strtoupper(substr($job->title,0,1)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('dashboard.jobs.show', $job->id) }}" class="font-medium text-gray-900 dark:text-gray-100 truncate hover:text-emerald-700">{{ $job->title }}</a>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $job->created_at?->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Applicants: {{ $job->applications_count ?? 0 }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500 dark:text-gray-400">No posted jobs yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
