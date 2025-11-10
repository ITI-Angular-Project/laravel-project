@extends('layouts.main.app')

@section('content')
    <div class="container mx-auto py-10 px-4 md:px-0 max-w-5xl">

        {{-- 🔙 Back Button --}}
        <div class="mb-6">
            <a href="{{ route('jobs') }}"
                class="text-sm text-amber-600 hover:text-amber-500 font-semibold flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Jobs
            </a>
        </div>

        <div
            class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8 transition-transform transform hover:scale-[1.01]">

            {{-- Job Title --}}
            <h1
                class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-gray-100 tracking-tight mb-10 transition-colors">
                {{ $job->title }}
            </h1>

            {{-- Grid Layout: Left Info + Right Qualifications --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">

                {{-- Left Info --}}
                <div class="space-y-4">
                    @php
                        $info = [
                            ['label' => 'Company', 'value' => $job->company->name ?? 'N/A'],
                            ['label' => 'Category', 'value' => $job->category->name ?? 'N/A'],
                            ['label' => 'Work Type', 'value' => str_replace('_', ' ', $job->work_type)],
                            ['label' => 'Deadline', 'value' => \Carbon\Carbon::parse($job->deadline)->format('Y-m-d')],
                            [
                                'label' => 'Salary',
                                'value' =>
                                    $job->salary_min && $job->salary_max
                                        ? "$" . $job->salary_min . " - $" . $job->salary_max
                                        : 'Not specified',
                            ],
                            ['label' => 'Technologies', 'value' => $job->technologies_txt ?? 'Not specified'],
                        ];
                    @endphp

                    @foreach ($info as $item)
                        <div
                            class="flex justify-between items-center bg-gray-50 dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700
                                       transition-transform transform hover:scale-105 hover:shadow-lg cursor-pointer">
                            <h3 class="text-sm text-gray-500 dark:text-gray-400 font-semibold">{{ $item['label'] }}</h3>
                            <p class="text-base font-medium text-gray-900 dark:text-gray-100">{{ $item['value'] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Right Qualifications --}}
                <div
                    class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700
                           transition-transform transform hover:scale-105 hover:shadow-lg cursor-pointer">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">Qualifications</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $job->qualifications ?? 'No qualifications required' }}
                    </p>
                </div>

            </div>

            {{-- Description --}}
            <section
                class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 mb-8 shadow-sm border border-gray-100 dark:border-gray-700
                       transition-transform transform hover:scale-105 hover:shadow-lg cursor-pointer">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">Description</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                    {{ $job->description ?? 'No description provided' }}
                </p>
            </section>

            {{-- Benefits --}}
            <section
                class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 mb-8 shadow-sm border border-gray-100 dark:border-gray-700
                       transition-transform transform hover:scale-105 hover:shadow-lg cursor-pointer">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-3">Benefits</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                    {{ $job->benefits ?? 'No benefits specified' }}
                </p>
            </section>

            {{-- Apply + Add Comment Buttons --}}
            <div class="mt-8 flex flex-col md:flex-row justify-center md:justify-between items-center gap-4">
                @auth
                    <a href="javascript:void(0);" id="addCommentBtn"
                        class="inline-flex items-center justify-center rounded-2xl bg-blue-500 px-8 py-3 text-lg font-semibold text-white hover:bg-blue-400 hover:scale-105 transition-transform duration-200">
                        Add Comment
                    </a>

                    {{-- حتكون دي DIV الفورم اللي هيظهر --}}


                    {{-- Apply Button (AJAX) --}}
                    <button id="applyBtn" data-job-id="{{ $job->id }}" type="button"
                        class="apply-btn inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                                   hover:bg-amber-400 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-300 transition-transform duration-200">
                        Apply Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-8 py-3 text-lg font-semibold text-slate-950
                                  hover:bg-amber-400 hover:scale-105 transition-transform duration-200">
                        Login to Apply / Comment
                    </a>
                @endauth
            </div>
            <div id="commentFormContainer" class="mt-4"></div>


            {{-- Comments Section --}}
            @php
                $comments = $job->comments()->orderBy('created_at', 'desc')->take(5)->get();
            @endphp

            <div id="commentsList">
                @foreach ($comments as $comment)
                    <div class="border-b border-gray-200 dark:border-gray-700 py-4 comment-item">
                        <p class="text-gray-900 dark:text-gray-100 font-medium">{{ $comment->user->name ?? 'Anonymous' }}
                        </p>
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->body }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>

            @if ($job->comments()->count() > 5)
                <div class="mt-4 text-center">
                    <button id="showMoreCommentsBtn"
                        class="px-6 py-3 bg-gray-200 dark:bg-gray-700 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Show More
                    </button>
                </div>
            @endif


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

        // دالة عرض التوست
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
            // Intersection Observer للتأثيرات عند الظهور
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

            // التعامل مع أزرار Apply
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
                                showToast('error', data.message || 'Failed to apply.');
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
            const commentsContainer = document.querySelector('#commentsList');

            // إظهار الفورم عند الضغط على زر Add Comment
            addCommentBtn?.addEventListener('click', () => {
                commentFormContainer.innerHTML = `
                    <div class="flex flex-col gap-3 w-full bg-gray-50 dark:bg-gray-900 p-4 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 transition-transform transform hover:scale-[1.01]">
                    <textarea id="commentInput" placeholder="Write your comment..." rows="4"
                    class="flex-1 p-4 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100
                    focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-300 resize-none w-full shadow-sm transition-all duration-200"></textarea>
                    <div class="flex flex-col gap-2 w-full">
                    <button id="saveCommentBtn"
                    class="w-full px-6 py-3 bg-blue-600 dark:bg-blue-500 text-white font-semibold rounded-xl shadow hover:bg-blue-500 dark:hover:bg-blue-400
                    transition-all duration-300 transform hover:scale-80">
                    Save
                    </button>
                    <button id="cancelCommentBtn"
                    class="w-full px-6 py-3 bg-red-600 dark:bg-red-500 text-white font-semibold rounded-xl shadow hover:bg-red-500 dark:hover:bg-red-400
                    transition-all duration-300 transform hover:scale-80">
                    Cancel
                    </button>
                    </div>
                    </div>
`;

                // إضافة وظيفة إغلاق الفورم عند الضغط على Cancel
                document.getElementById('cancelCommentBtn')?.addEventListener('click', () => {
                    commentFormContainer.innerHTML = '';
                });

                document.getElementById('commentInput').focus();

                // إضافة حدث الزر Save
                document.getElementById('saveCommentBtn').addEventListener('click', () => {
                    const body = document.getElementById('commentInput').value.trim();
                    if (!body) return alert('Comment cannot be empty');

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
                                // إضافة الكومنت فوراً للـ DOM
                                const commentDiv = document.createElement('div');
                                commentDiv.className =
                                    'border-b border-gray-200 dark:border-gray-700 py-4';
                                commentDiv.innerHTML = `
                            <p class="text-gray-900 dark:text-gray-100 font-medium">${data.comment.user_name}</p>
                            <p class="text-gray-700 dark:text-gray-300">${data.comment.body}</p>
                            <p class="text-xs text-gray-500 mt-1">Just now</p>
                        `;
                                commentsContainer.prepend(commentDiv);

                                // إعادة تعيين الفورم
                                commentFormContainer.innerHTML = '';
                            } else {
                                alert(data.message || 'Failed to submit comment');
                            }
                        })
                        .catch(err => {
                            alert('Error occurred. Try again.');
                            console.error(err);
                        });
                });
            });

        });

        let commentsOffset = 5;
        const showMoreBtn = document.getElementById('showMoreCommentsBtn');
        const commentsContainer = document.getElementById('commentsList');

        showMoreBtn?.addEventListener('click', () => {
            const jobId = {{ $job->id }};
            fetch(`/jobs/${jobId}/comments?offset=${commentsOffset}`)
                .then(res => res.json())
                .then(data => {
                    data.comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.className =
                            'border-b border-gray-200 dark:border-gray-700 py-4 comment-item';
                        commentDiv.innerHTML = `
                    <p class="text-gray-900 dark:text-gray-100 font-medium">${comment.user_name}</p>
                    <p class="text-gray-700 dark:text-gray-300">${comment.body}</p>
                    <p class="text-xs text-gray-500 mt-1">${comment.time_diff}</p>
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
@endsection
