@extends('layouts.dashboard.app')

@section('content')
    <div class="container mx-auto ">

        {{-- 🔹 Title + Search + Filter + New Job --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">

            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">My Jobs</h2>

            <form action="{{ route('dashboard.jobs.index') }}" method="GET"
                class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full sm:w-auto">

                {{-- Search Bar --}}
                <div class="flex w-full sm:w-auto gap-4">
                    <input type="text" name="search" placeholder="Search jobs..." value="{{ request('search') }}"
                        class="flex-1 px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700
                           bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition" />

                </div>

                {{-- Status Filter --}}
                <select name="status"
                    class="ml-0 sm:ml-2 px-8 py-2 rounded-xl border border-gray-300 dark:border-gray-700
                       bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none
                       focus:ring-2 focus:ring-indigo-500/50 transition">
                    <option value="">All Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <button type="submit"
                    class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition-all duration-200">
                    Search / Apply
                </button>

                {{-- New Job Button --}}
                <a href="{{ route('dashboard.jobs.create') }}"
                    class="ml-0 sm:ml-2 group inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700
                       hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold
                       py-3.5 px-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform
                       hover:-translate-y-1 hover:scale-[1.03] active:scale-[0.98] relative overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                    <span
                        class="inline-flex h-6 w-6 items-center justify-center rounded-xl bg-white/15 group-hover:bg-white/25 transition-all duration-300 group-hover:rotate-90"
                        aria-hidden="true">+</span>
                    <span class="relative z-10">New Job</span>
                </a>
            </form>
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
            <div
                class="overflow-x-auto bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-200 dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($jobs as $job)
                            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50/60 hover:to-purple-50/60
                           dark:hover:from-indigo-900/10 dark:hover:to-purple-900/10 transition-all
                           hover:shadow-lg hover:scale-[1.01] animate-in fade-in slide-in-from-left duration-500 cursor-pointer"
                                style="animation-delay: {{ $loop->index * 50 }}ms"
                                onclick="window.location='{{ route('dashboard.jobs.show', $job->id) }}'">

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
                                    <span @class([
                                        'px-3 py-1 rounded-full text-xs font-semibold',
                                        'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100' =>
                                            $job->status === 'approved',
                                        'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100' =>
                                            $job->status === 'pending',
                                        'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100' => !in_array(
                                            $job->status,
                                            ['approved', 'pending']),
                                    ])>
                                        {{ ucfirst($job->status) }}
                                    </span>

                                </td>
                                <td class="px-6 py-4 text-center flex justify-center gap-3">
                                    <a href="{{ route('dashboard.jobs.edit', $job->id) }}"
                                        onclick="event.stopPropagation()"
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800
                                          hover:bg-gray-200 dark:hover:bg-gray-700 text-indigo-600 dark:text-indigo-400
                                          transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/50
                                          transform hover:scale-110 hover:shadow-lg active:scale-95 group">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors duration-200"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('dashboard.jobs.destroy', $job->id) }}" method="POST"
                                        onsubmit="event.stopPropagation(); return confirm('Are you sure you want to delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800
                                               hover:bg-gray-200 dark:hover:bg-gray-700 text-red-600 dark:text-red-400
                                               transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500/50
                                               transform hover:scale-110 hover:shadow-lg active:scale-95 group">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 group-hover:text-red-700 dark:group-hover:text-red-300 transition-colors duration-200"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        @endif

    </div>
@endsection
