@extends('layouts.dashboard.app')

@section('content')
<div class="container mx-auto py-6 px-4 md:px-0 max-w-6xl">

    {{-- 🔙 Back Button --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.jobs.index') }}" class="inline-flex items-center text-sm text-amber-600 hover:text-amber-700 dark:text-amber-400 dark:hover:text-amber-300 font-medium transition-all duration-200 hover:gap-2 gap-1 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Jobs
        </a>
    </div>

    {{-- 🧾 Job/Application Card --}}
<div class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300">

    {{-- Header with gradient background --}}
    <div class="relative bg-amber-600/10 dark:bg-amber-600/10 p-5 overflow-hidden ring-1 ring-inset ring-amber-600/20">
        {{-- Decorative blurred corner accents with custom color --}}
        <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl" style="background-color: oklch(75% 0.183 55.934 / 0.5);"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl" style="background-color: oklch(75% 0.183 55.934 / 0.35);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 rounded-full blur-xl" style="background-color: oklch(75% 0.183 55.934 / 0.25);"></div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
            <h1 class="text-2xl md:text-3xl font-bold text-amber-700 dark:text-amber-300 tracking-tight drop-shadow-sm">
                {{ $application->job->title ?? $job->title }}
            </h1>
            @php
                $statusClasses = match ($application->status ?? $job->status) {
                    'approved', 'submitted' => 'bg-green-500 text-white shadow-lg shadow-green-500/30',
                    'pending' => 'bg-yellow-400 text-gray-900 shadow-yellow-400/30',
                    default => 'bg-red-500 text-white shadow-red-500/30',
                };
            @endphp
            <span class="px-4 py-1.5 rounded-full font-semibold text-xs shadow-lg {{ $statusClasses }}">
                {{ ucfirst($application->status ?? $job->status) }}
            </span>
        </div>
    </div>

        {{-- Content Section --}}
        <div class="p-5">
            {{-- Compact Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-5">
                @php
                    $info = [
                        ['label' => 'Company', 'value' => $application->job->company->name ?? $job->company->name ?? 'N/A', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['label' => 'Category', 'value' => $application->job->category->name ?? $job->category->name ?? 'N/A', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                        ['label' => 'Work Type', 'value' => str_replace('_', ' ', $application->job->work_type ?? $job->work_type), 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label' => 'Deadline', 'value' => \Carbon\Carbon::parse($application->job->deadline ?? $job->deadline)->format('Y-m-d'), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label' => 'Salary', 'value' => ($application->job->salary_min ?? $job->salary_min) && ($application->job->salary_max ?? $job->salary_max) ? "$".($application->job->salary_min ?? $job->salary_min)." - $".($application->job->salary_max ?? $job->salary_max) : "Not specified", 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Technologies', 'value' => $application->job->technologies_txt ?? $job->technologies_txt ?? 'Not specified', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                        ['label' => 'Applicant', 'value' => $application->applicant_name ?? 'N/A', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['label' => 'Email', 'value' => $application->applicant_email ?? 'N/A', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label' => 'Phone', 'value' => $application->applicant_phone ?? 'N/A', 'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
                    ];
                @endphp

                @foreach($info as $item)
                    <div class="group bg-white dark:bg-gray-800 p-3 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                            <h3 class="text-[10px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $item['label'] }}</h3>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate" title="{{ $item['value'] }}">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Compact Job Sections --}}
            <div class="grid md:grid-cols-2 gap-3 mb-5">
                @php
                    $sections = [
                        ['title' => 'Description', 'content' => $application->job->description ?? $job->description, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['title' => 'Responsibilities', 'content' => $application->job->responsibilities ?? $job->responsibilities, 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                        ['title' => 'Qualifications', 'content' => $application->job->qualifications ?? $job->qualifications, 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                        ['title' => 'Benefits', 'content' => $application->job->benefits ?? $job->benefits, 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'],
                    ];
                @endphp

                @foreach($sections as $section)
                    @if($section['content'])
                        <section class="bg-white dark:bg-gray-800 rounded-xl p-3.5 border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="bg-amber-100 dark:bg-amber-900/30 p-1.5 rounded-lg">
                                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $section['icon'] }}"/>
                                    </svg>
                                </div>
                                <h2 class="text-base font-bold text-gray-800 dark:text-gray-100">{{ $section['title'] }}</h2>
                            </div>
                            <div class="max-h-32 overflow-y-auto scrollbar-thin scrollbar-thumb-amber-400 scrollbar-track-gray-100 dark:scrollbar-track-gray-700">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-xs whitespace-pre-line">
                                    {{ $section['content'] }}
                                </p>
                            </div>
                        </section>
                    @endif
                @endforeach
            </div>

            {{-- Compact Action Buttons --}}
            @if(auth()->check() && auth()->user()->hasRole(['admin','employer']))
            <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                <x-ui.button href="{{ route('dashboard.jobs.edit', $application->job->id ?? $job->id) }}">
                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Job
                </x-ui.button>

                <x-ui.confirm-modal :action="route('dashboard.jobs.destroy', $application->job->id ?? $job->id)" method="DELETE"
                    title="Delete Job"
                    :description="__('Deleting this job will remove all associated applications and analytics.')"
                    confirm-text="Delete Job" cancel-text="Cancel">
                    <x-slot:trigger>
                        <x-ui.button variant="danger">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Job
                        </x-ui.button>
                    </x-slot:trigger>
                    <p>Please confirm you want to permanently remove this job posting.</p>
                </x-ui.confirm-modal>
            </div>
            @endif
        </div>

    </div>
</div>

{{-- ========== Applications Section (Full Width) ========== --}}
@if($job->applications->count() > 0)
    <div class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300 mt-6">

        {{-- Header with gradient background --}}
        <div class="relative bg-amber-600/10 dark:bg-amber-600/10 p-5 overflow-hidden ring-1 ring-inset ring-amber-600/20">
            {{-- Decorative blurred corner accents --}}
            <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl" style="background-color: oklch(75% 0.183 55.934 / 0.5);"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl" style="background-color: oklch(75% 0.183 55.934 / 0.35);"></div>

            <div class="relative z-10">
                <h3 class="text-2xl md:text-3xl font-bold text-amber-700 dark:text-amber-300 tracking-tight drop-shadow-sm">
                    Applications
                    <span class="ml-2 text-lg font-semibold text-amber-600 dark:text-amber-400">({{ $job->applications->count() }})</span>
                </h3>
            </div>
        </div>

        {{-- Table Content --}}
        <div class="p-5">
            <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Name</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Status</th>
                            <th class="px-4 py-3 text-left font-semibold">Applied</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($job->applications as $app)
                            <tr class="hover:bg-amber-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                <td class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-100">
                                    <a href="{{ route('dashboard.applications.show', $app->id) }}" class="hover:text-amber-600 dark:hover:text-amber-400 transition-colors">
                                        {{ $app->applicant_name }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $app->applicant_email }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($app->status === 'accepted')
                                            bg-green-600/10 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20
                                        @elseif($app->status === 'rejected')
                                            bg-red-600/10 text-red-700 dark:text-red-300 ring-1 ring-inset ring-red-600/20
                                        @else
                                            bg-yellow-400 text-gray-900 shadow-yellow-400/30
                                        @endif">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $app->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 text-center mt-6">
        <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
        </svg>
        <p class="text-gray-500 dark:text-gray-400 font-medium">No applications yet for this job.</p>
    </div>
@endif

{{-- ========== Comments Section (Full Width) ========== --}}
<div class="mt-6">
    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Comments</h3>

    <div id="comments-container">
        @if($job->comments->count() > 0)
            <div class="space-y-4" id="comments-list">
                @foreach($job->comments->take(5) as $comment)
                    <div class="p-4 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                <span class="font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $comment->user?->name ?? 'Unknown User' }}
                                </span>
                                <span class="text-gray-400 text-xs ml-2">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </p>
                            <p class="mt-1 text-gray-600 dark:text-gray-400 text-sm">
                                {{ $comment->body }}
                            </p>
                        </div>

                        {{-- delete button --}}
                        @if(Auth::check() && Auth::user()->hasRole(['employer', 'admin']))
                            <form action="{{ route('dashboard.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                @csrf
                                @method('DELETE')
                                <button class='bg-red-600/10 text-red-400 dark:text-red-300 ring-1 ring-inset ring-red-600/20 rounded-full px-4 py-1.5 text-xs font-semibold'>Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($job->comments->count() > 5)
                <div class="text-center mt-4">
                    <button id="load-more-comments" class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200" data-offset="5">
                        Show More Comments
                    </button>
                </div>
            @endif
        @else
            <p class="text-gray-500 dark:text-gray-400 text-sm">No comments yet.</p>
        @endif
    </div>
</div>


{{-- Custom scrollbar styles --}}
<style>
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .scrollbar-thumb-amber-400::-webkit-scrollbar-thumb {
        background-color: rgb(251 191 36);
        border-radius: 3px;
    }
    .scrollbar-track-gray-100::-webkit-scrollbar-track {
        background-color: rgb(243 244 246);
    }
    .dark .scrollbar-track-gray-700::-webkit-scrollbar-track {
        background-color: rgb(55 65 81);
    }
</style>

{{-- JavaScript for Load More Comments --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-comments');
    const commentsList = document.getElementById('comments-list');
    const jobId = {{ $job->id }};
    const canDeleteComments = {{ Auth::check() && Auth::user()->hasRole(['employer', 'admin']) ? 'true' : 'false' }};

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const offset = parseInt(this.getAttribute('data-offset'));

            fetch(`/jobs/${jobId}/comments?offset=${offset}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.comments && data.comments.length > 0) {
                    data.comments.forEach(comment => {
                        let deleteButton = '';
                        if (canDeleteComments) {
                            deleteButton = `
                                <form action="/dashboard/comments/${comment.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')" style="margin-left: auto;">
                                    @csrf
                                    @method('DELETE')
                                    <button class='bg-red-600/10 text-red-400 dark:text-red-300 ring-1 ring-inset ring-red-600/20 rounded-full px-4 py-1.5 text-xs font-semibold'>Delete</button>
                                </form>
                            `;
                        }

                        const commentHtml = `
                            <div class="p-4 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-semibold text-gray-900 dark:text-gray-100">
                                            ${comment.user_name}
                                        </span>
                                        <span class="text-gray-400 text-xs ml-2">
                                            ${comment.time_diff}
                                        </span>
                                    </p>
                                    <p class="mt-1 text-gray-600 dark:text-gray-400 text-sm">
                                        ${comment.body}
                                    </p>
                                </div>
                                ${deleteButton}
                            </div>
                        `;
                        commentsList.insertAdjacentHTML('beforeend', commentHtml);
                    });

                    // Update offset
                    this.setAttribute('data-offset', offset + 5);

                    // Hide button if no more comments
                    if (!data.has_more) {
                        this.style.display = 'none';
                    }
                } else {
                    this.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error loading more comments:', error);
            });
        });
    }
});
</script>
@endsection
