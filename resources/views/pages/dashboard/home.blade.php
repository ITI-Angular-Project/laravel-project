@extends('layouts.dashboard.app')

@section('content')
    <div class="container mx-auto py-6">

        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mb-8">
            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-sm text-gray-500 dark:text-gray-400">Posted Jobs</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ $recentJobs->count() }}</div>
            </div>
            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-sm text-gray-500 dark:text-gray-400">New Applications</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">25</div>
            </div>
            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-sm text-gray-500 dark:text-gray-400">Closed Jobs</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">3</div>
            </div>
            <div class="rounded-2xl p-5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="text-sm text-gray-500 dark:text-gray-400">Total Applicants</div>
                <div class="mt-2 text-3xl font-semibold text-gray-900 dark:text-gray-100">72</div>
            </div>
        </div>


        {{-- 🔹 Recent Jobs Table --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

            {{--  Jobs Table --}}
            <div
                class="lg:col-span-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Recent Jobs</h3>
                <table class="min-w-full text-sm">
                    <thead class="text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">
                        <tr>
                            <th class="py-2 text-left">Job Title</th>
                            <th class="py-2 text-left">Status</th>
                            <th class="py-2 text-left">Applicants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentJobs as $job)
                            <tr
                                class="border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/40 transition">
                                <td class="py-2 font-medium text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="hover:text-blue-600">
                                        {{ $job->title }}
                                    </a>
                                </td>
                                <td class="py-2 capitalize">
                                    <span
                                        class="@if ($job->status == 'approved') text-green-600 @elseif($job->status == 'pending') text-yellow-600 @else text-red-600 @endif">
                                        {{ $job->status }}
                                    </span>
                                </td>
                                <td class="py-2 text-gray-700 dark:text-gray-300">
                                    {{ $job->applications_count ?? 0 }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-3 text-center text-gray-500 dark:text-gray-400">
                                    No recent jobs found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Quick Actions   --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Quick Actions</h3>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('jobs.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-center">
                        + Add Job
                    </a>
                    <a href="{{ route('profile.edit') }}"
                        class="bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100 font-semibold py-2 rounded-lg text-center">
                        Edit Profile
                    </a>
                </div>
            </div>

        </div>

    </div>
@endsection
