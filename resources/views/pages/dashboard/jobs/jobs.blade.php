@extends('layouts.dashboard.app')

@section('content')
    <div class="container mx-auto py-4">

        {{-- 🔹 العنوان و زر إضافة وظيفة --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">My Jobs</h2>
            <a href="{{ route('jobs.create') }}"
                class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                <span class="text-lg">+</span> New Job
            </a>
        </div>

        {{-- ✅ Success message --}}
        @if (session('success'))
            <div
                class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 border border-green-300 dark:border-green-700 rounded-xl p-4 mb-6 shadow-sm flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z"
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
            <div
                class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead
                        class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Work Type</th>
                            <th class="px-6 py-3 text-left">Salary</th>
                            <th class="px-6 py-3 text-left">Deadline</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($jobs as $job)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-200"
                                onclick="window.location='{{ route('jobs.show', $job->id) }}'">

                                <td class="px-6 py-4 text-gray-800 dark:text-gray-100 font-medium">{{ $job->title }}</td>
                                <td class="px-6 py-4 capitalize text-gray-600 dark:text-gray-300">
                                    {{ str_replace('_', ' ', $job->work_type) }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    @if ($job->salary_min && $job->salary_max)
                                        ${{ $job->salary_min }} - ${{ $job->salary_max }}
                                    @else
                                        <span class="text-gray-400">Not specified</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
            @if ($job->status == 'approved') bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100
            @elseif($job->status == 'pending') bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100
            @else bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100 @endif">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center flex justify-center gap-3">
                                    <!-- Edit -->
                                    <a href="{{ route('jobs.edit', $job->id) }}" onclick="event.stopPropagation()"
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M16 3l5 5M21 3l-5 5" />
                                        </svg>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                        onsubmit="event.stopPropagation(); return confirm('Are you sure you want to delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a2 2 0 00-2 2v0a2 2 0 002 2h4a2 2 0 002-2v0a2 2 0 00-2-2m-4 0v0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        @endif

    </div>
@endsection
