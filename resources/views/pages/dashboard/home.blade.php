@extends('layouts.dashboard.app')

@section('content')
<div x-data="{ darkMode: document.documentElement.classList.contains('dark') }"
     x-init="$watch('darkMode', value => document.documentElement.classList.toggle('dark', value))"
     class="min-h-screen transition-colors duration-500 ease-in-out bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="container mx-auto py-6">

        {{-- 🔹 Dashboard Summary Cards --}}
        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mb-8">
            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-bottom duration-500 delay-100">
                <div class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-500">Recent Jobs</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100 transition-colors duration-500">
                    {{ $recentJobs->count() }}
                </div>
            </div>

            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-bottom duration-500 delay-150">
                <div class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-500">New Applications</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100 transition-colors duration-500">{{ $newApplications }}</div>
            </div>

            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-bottom duration-500 delay-200">
                <div class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-500">Closed Jobs</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100 transition-colors duration-500">{{ $closedJobs }}</div>
            </div>

            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-bottom duration-500 delay-250">
                <div class="text-sm text-gray-500 dark:text-gray-400 transition-colors duration-500">Total Applicants</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100 transition-colors duration-500">{{ $totalApplications }}</div>
            </div>
        </div>

        {{-- 🔹 Recent Jobs Table --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

            <div class="lg:col-span-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-5
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-bottom duration-500 delay-150">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 transition-colors duration-500">Recent Jobs</h3>
                <table class="min-w-full text-sm transition-colors duration-500">
                    <thead class="text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="py-2 text-left">Job Title</th>
                            <th class="py-2 text-left">Status</th>
                            <th class="py-2 text-left">Applicants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentJobs as $job)
                        <tr class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors duration-500">
                            <td class="py-2 font-medium text-gray-900 dark:text-gray-100 transition-colors duration-500">
                                <a href="{{ route('jobs.show', $job->id) }}" class="hover:text-blue-600 transition-colors duration-300">
                                    {{ $job->title }}
                                </a>
                            </td>
                            <td class="py-2 capitalize">
                                <span class="@if ($job->status == 'approved') text-green-600 @elseif($job->status == 'pending') text-yellow-600 @else text-red-600 @endif transition-colors duration-500">
                                    {{ $job->status }}
                                </span>
                            </td>
                            <td class="py-2 text-gray-700 dark:text-gray-300 transition-colors duration-500">
                                {{ $job->applications_count ?? 0 }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-3 text-center text-gray-500 dark:text-gray-400 transition-colors duration-500">
                                No recent jobs found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 🔹 Quick Actions --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-5
                        transition-colors duration-500 ease-in-out animate-in fade-in slide-in-from-right duration-500 delay-200">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 transition-colors duration-500">Quick Actions</h3>

                <div class="flex flex-col sm:flex-row gap-3">
                    {{-- Add Job --}}
                    <a href="{{ route('jobs.create') }}"
                        class="group inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold py-3.5 px-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.03] active:scale-[0.98] motion-safe:transition relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-xl bg-white/15 group-hover:bg-white/25 transition-all duration-300 group-hover:rotate-90" aria-hidden="true">+</span>
                        <span class="relative z-10">Add Job</span>
                    </a>

                    {{-- Edit Profile --}}
                    <a href="{{ route('profile.edit') }}"
                        class="group inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold py-3.5 px-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.03] active:scale-[0.98] motion-safe:transition relative overflow-hidden">
                        <span class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-xl bg-white/15 group-hover:bg-white/25 transition-all duration-300 group-hover:rotate-90" aria-hidden="true">✎</span>
                        <span class="relative z-10">Edit Profile</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
