@extends('layouts.main.app')

@section('content')
    <div class="container mx-auto py-6 px-4 md:px-0 max-w-6xl">

        {{-- 🔙 Back Button --}}
        <div class="mb-3">
            <a href="{{ route('jobs') }}" class="inline-flex items-center text-sm text-amber-600 hover:text-amber-700 dark:text-amber-400 dark:hover:text-amber-300 font-medium transition-all duration-200 hover:gap-2 gap-1 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Jobs
            </a>
        </div>

        <div class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300">

            {{-- Header with gradient background --}}
            <div class="relative bg-amber-600/10 dark:bg-amber-600/10 p-5 overflow-hidden ring-1 ring-inset ring-amber-600/20">
                {{-- Decorative blurred corner accents with custom color --}}
                <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl" style="background-color: oklch(75% 0.183 55.934 / 0.5);"></div>
                <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl" style="background-color: oklch(75% 0.183 55.934 / 0.35);"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 rounded-full blur-xl" style="background-color: oklch(75% 0.183 55.934 / 0.25);"></div>

                <div class="relative z-10">
                    <h1 class="text-2xl md:text-3xl font-bold text-amber-700 dark:text-amber-300 tracking-tight drop-shadow-sm">
                        {{ $job->title }}
                    </h1>
                </div>
            </div>

            {{-- Content Section --}}
            <div class="p-5">

            {{-- Compact Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-5">
                @php
                    $info = [
                        ['label' => 'Company', 'value' => $job->company->name ?? 'N/A', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['label' => 'Category', 'value' => $job->category->name ?? 'N/A', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                        ['label' => 'Work Type', 'value' => str_replace('_', ' ', $job->work_type), 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                        ['label' => 'Deadline', 'value' => \Carbon\Carbon::parse($job->deadline)->format('Y-m-d'), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label' => 'Salary', 'value' => ($job->salary_min && $job->salary_max) ? "$".$job->salary_min." - $".$job->salary_max : "Not specified", 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Technologies', 'value' => $job->technologies_txt ?? 'Not specified', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
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
                        ['title' => 'Description', 'content' => $job->description, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['title' => 'Qualifications', 'content' => $job->qualifications, 'icon' => 'M9 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                        ['title' => 'Benefits', 'content' => $job->benefits, 'icon' => 'M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7'],
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
            <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                @auth
                    <a href="javascript:void(0);" id="addCommentBtn"
                        class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-5 py-1 text-lg font-semibold text-slate-950 hover:bg-amber-400 transition-all duration-200">
                        Add Comment
                    </a>

                    {{-- Apply Button (AJAX) --}}
                    @php
                        $hasApplied = \App\Models\Application::where('candidate_id', auth()->id())->where('job_id', $job->id)->exists();
                    @endphp
                    @if($hasApplied)
                    <button type="button"
                    class="inline-flex items-center justify-center rounded-2xl bg-green-500 px-8 py-3 text-lg font-semibold text-white cursor-not-allowed"
                    disabled>
                    Applied
                </button>
                    @else
                    @can('candidate-view')
                    <button id="applyBtn" data-job-id="{{ $job->id }}" type="button"
                        class="apply-btn inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                        hover:bg-amber-400 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-300 transition-transform duration-200">
                        Apply Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                    @endcan
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                                  hover:bg-amber-400 transition-all duration-200">
                        Login to Apply / Comment
                    </a>
                @endauth
            </div>
            <div id="commentFormContainer" class="mt-4"></div>


            {{-- Comments Section --}}
            @php
                $initialComments = $job->comments->sortByDesc('created_at')->take(5);
                $totalComments = $job->comments->count();
            @endphp

            {{-- Comments Section --}}
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Comments ({{ $totalComments }})</h3>

                <div id="comments-container">
                    @if($totalComments > 0)
                        <div class="space-y-4" id="comments-list">
                            @foreach ($initialComments as $comment)
                                <div class="p-4 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            <span class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $comment->user->name ?? 'Anonymous' }}
                                            </span>
                                            <span class="text-gray-400 text-xs ml-2">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </span>
                                        </p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-400 text-sm">
                                            {{ $comment->body }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($totalComments > 5)
                            <div class="text-center mt-4">
                                <button id="showMoreCommentsBtn" class="bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200" data-offset="5">
                                    Show More Comments
                                </button>
                            </div>
                        @endif
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No comments yet.</p>
                    @endif
                </div>
            </div>



            </div>
        </div>
    </div>
    <script>
        function homeHero(slides) {
            return {
                slides: Array.isArray(slides) && slides.length ? slides : [{
                    title: 'Discover your next role',
                    subtitle: 'Explore curated opportunities from leading teams.',
                    image: "{{ asset('about_us/1.jpg') }}"
                }],
                active: 0,
                timer: null,
                start() {
                    this.tick();
                    this.timer = setInterval(() => this.next(), 6000);
                },
                next() {
                    this.active = (this.active + 1) % this.slides.length;
                },
                tick() {
                    this.active = 0;
                }
            }
        }

        // Function to show toast
        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.textContent = message;
            toast.className = `fixed bottom-5 right-5 z-50 px-5 py-3 rounded-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'
                } shadow-lg animate-fade-in-up`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Intersection Observer for effects on appearance
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2,
                rootMargin: '0px 0px -5% 0px'
            });

            document.querySelectorAll('.animate-fade-in-up').forEach(el => observer.observe(el));

            // Handle Apply buttons
            document.querySelectorAll('.apply-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-job-id');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`/apply/${jobId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast('success', data.message || 'Application submitted!');
                            } else {
                                window.location.href = `/job/${jobId}/complete-profile`;
                            }
                        })
                        .catch(error => {
                            showToast('error', 'An error occurred. Please try again.');
                        });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', () => {

            const addCommentBtn = document.getElementById('addCommentBtn');
            const commentFormContainer = document.getElementById('commentFormContainer');
            const commentsContainer = document.querySelector('#comments-list');

            // Show form when clicking Add Comment button
            addCommentBtn?.addEventListener('click', () => {
                commentFormContainer.innerHTML = `
                    <div class="flex flex-col gap-4 w-full bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm transition-all duration-200">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <h3 class="text-base font-bold text-gray-800 dark:text-gray-100">Add Your Comment</h3>
                        </div>
                        <textarea id="commentInput" placeholder="Share your thoughts..." rows="4"
                        class="flex-1 p-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100
                        focus:outline-none focus:ring-2 focus:ring-amber-300 dark:focus:ring-amber-500 focus:border-amber-400 dark:focus:border-amber-500 resize-none w-full transition-all duration-200 placeholder-gray-500 dark:placeholder-gray-400"></textarea>
                        <div class="flex flex-row gap-2 w-full">
                            <button id="saveCommentBtn"
                            class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Comment
                            </button>
                            <button id="cancelCommentBtn"
                            class="flex-1 flex items-center justify-center gap-2 px-3 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-gray-100 font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </button>
                        </div>
                    </div>
`;

                // Add function to close form when clicking Cancel
                document.getElementById('cancelCommentBtn')?.addEventListener('click', () => {
                    commentFormContainer.innerHTML = '';
                });

                // Add function to close form when pressing Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        commentFormContainer.innerHTML = '';
                    }
                });

                document.getElementById('commentInput').focus();

                // Add event for Save button
                document.getElementById('saveCommentBtn').addEventListener('click', () => {
                    const body = document.getElementById('commentInput').value.trim();
                    if (!body) {
                        showToast('error', 'Comment cannot be empty');
                        return;
                    }

                    const saveBtn = document.getElementById('saveCommentBtn');
                    const originalText = saveBtn.innerHTML;
                    saveBtn.disabled = true;
                    saveBtn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Saving...';

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');
                    const jobId = {{ $job->id }};

                    fetch(`/jobs/${jobId}/comment`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                body
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                // Add comment immediately to DOM
                                const commentDiv = document.createElement('div');
                                commentDiv.className =
                                    'p-4 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex justify-between items-start';
                                commentDiv.innerHTML = `
                            <div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        ${data.comment.user_name}
                                    </span>
                                    <span class="text-gray-400 text-xs ml-2">
                                        Just now
                                    </span>
                                </p>
                                <p class="mt-1 text-gray-600 dark:text-gray-400 text-sm">
                                    ${data.comment.body}
                                </p>
                            </div>
                        `;
                                commentsContainer.prepend(commentDiv);

                                // Reset the form
                                commentFormContainer.innerHTML = '';
                                showToast('success', 'Comment added successfully!');
                            } else {
                                showToast('error', data.message || 'Failed to submit comment');
                                saveBtn.disabled = false;
                                saveBtn.innerHTML = originalText;
                            }
                        })
                        .catch(err => {
                            showToast('error', 'Error occurred. Try again.');
                            saveBtn.disabled = false;
                            saveBtn.innerHTML = originalText;
                            console.error(err);
                        });
                });
            });

        });

        let commentsOffset =  {{ $initialComments->count() }};
        const showMoreBtn = document.getElementById('showMoreCommentsBtn');
        const commentsContainer = document.getElementById('comments-list');

        showMoreBtn?.addEventListener('click', () => {
            const jobId = {{ $job->id }};
            fetch(`/jobs/${jobId}/comments?offset=${commentsOffset}`)
                .then(res => res.json())
                .then(data => {
                    data.comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.className =
                            'p-4 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex justify-between items-start';
                        commentDiv.innerHTML = `
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
                `;
                        commentsContainer.appendChild(commentDiv);
                    });

                    commentsOffset += data.comments.length;

                    if (!data.has_more) {
                        showMoreBtn.style.display = 'none';
                    }
                });
        });
    </script>

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
@endsection
