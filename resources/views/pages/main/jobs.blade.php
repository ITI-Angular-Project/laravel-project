@extends('layouts.main.app')

@section('content')
    <style>
        @keyframes float-soft {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .hero-floating {
            animation: float-soft 9s ease-in-out infinite;
        }
    </style>

    <div class="bg-gradient-to-b from-white via-slate-50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">

        <!-- Hero + Filters -->
        <section class="relative overflow-hidden">
            <div class="absolute inset-0" aria-hidden="true">
                <div
                    class="h-full w-full bg-[radial-gradient(circle_at_top,_rgba(245,158,11,0.15),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(59,130,246,0.15),_transparent_35%)] dark:bg-[radial-gradient(circle_at_top,_rgba(245,158,11,0.45),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(59,130,246,0.35),_transparent_35%)]">
                </div>
            </div>

            <div class="relative mx-auto flex max-w-6xl flex-col gap-10 px-4 py-16 sm:px-6 lg:px-8">
                <div class="space-y-5 text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-amber-600 dark:bg-white/10 dark:text-amber-200">
                        Thousands of vetted roles
                    </span>
                    <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-5xl">
                        Browse opportunities built for growth
                    </h1>
                    <p class="mx-auto max-w-2xl text-base text-slate-600 dark:text-slate-300 sm:text-lg">
                        Filter by location, seniority, salary and more. Every posting is screened to help you focus on the
                        interviews that matter.
                    </p>
                </div>

                <div
                    class="hero-floating rounded-3xl border border-white/60 bg-white/85 p-6 shadow-2xl backdrop-blur dark:border-white/10 dark:bg-white/5">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-5">
                        <div class="grid gap-3 md:grid-cols-[1.4fr_1.2fr_1.2fr_auto]">

                            <!-- Role or keyword -->
                            <label class="flex flex-col gap-2 text-sm text-slate-600 dark:text-slate-200">
                                <span class="font-semibold text-slate-900 dark:text-white">Role or keyword</span>
                                <div class="relative">
                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                                        placeholder="e.g. Product Designer"
                                        class="w-full rounded-2xl border border-white/60 bg-white/80 px-4 py-3 pl-11 text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 dark:border-white/20 dark:bg-white/10 dark:text-white dark:placeholder:text-white/60" />
                                </div>
                            </label>

                            <!-- Location -->
                            <label class="flex flex-col gap-2 text-sm text-slate-600 dark:text-slate-200">
                                <span class="font-semibold text-slate-900 dark:text-white">Location</span>
                                <div class="relative">
                                    <span
                                        class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="location" value="{{ request('location') }}"
                                        placeholder="City, Country"
                                        class="w-full rounded-2xl border border-white/60 bg-white/80 px-4 py-3 pl-11 text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 dark:border-white/20 dark:bg-white/10 dark:text-white dark:placeholder:text-white/60" />
                                    @if (request('location'))
                                        <button type="button"
                                            class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200"
                                            onclick="this.previousElementSibling.value=''; this.closest('form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </label>

                            <!-- Category -->
                            <label class="flex flex-col gap-2 text-sm text-slate-600 dark:text-slate-200">
                                <span class="font-semibold text-slate-900 dark:text-white">Category</span>
                                <select name="category_id"
                                    class="w-full rounded-2xl border border-white/60 bg-white/80 text-slate-900 dark:bg-slate-800 dark:text-white px-4 py-3 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                                    <option value="">All categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <button type="submit"
                                class="mt-auto inline-flex items-center justify-center rounded-2xl bg-amber-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                                Search jobs
                            </button>
                        </div>

                        <!-- Filters row 2 -->
                        <div class="grid gap-3 md:grid-cols-3">
                            <!-- Date posted -->
                            <label
                                class="flex flex-col gap-1 text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                Date posted
                                <select name="date_posted"
                                    class="rounded-2xl border border-white/60 bg-white/75 text-slate-900 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                                    <option value="">Anytime</option>
                                    <option value="24h" @selected(request('date_posted') === '24h')>Last 24 hours</option>
                                    <option value="7d" @selected(request('date_posted') === '7d')>Last 7 days</option>
                                    <option value="30d" @selected(request('date_posted') === '30d')>Last 30 days</option>
                                </select>
                            </label>

                            <!-- Salary range -->
                            <label
                                class="flex flex-col gap-1 text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                Salary range
                                <select name="salary_range"
                                    class="rounded-2xl border border-white/60 bg-white/75 text-slate-900 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                                    <option value="">All tiers</option>
                                    @foreach ($salaryRanges as $range)
                                        <option value="{{ $range }}" @selected(request('salary_range') === $range)>{{ $range }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            <!-- Work style -->
                            <label
                                class="flex flex-col gap-1 text-xs font-semibold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                                Work style
                                <select name="work_type"
                                    class="rounded-2xl border border-white/60 bg-white/75 text-slate-900 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30">
                                    <option value="">Any</option>
                                    <option value="remote" @selected(request('work_type') === 'remote')>Remote</option>
                                    <option value="on_site" @selected(request('work_type') === 'on_site')>On-site</option>
                                    <option value="hybrid" @selected(request('work_type') === 'hybrid')>Hybrid</option>
                                </select>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Results -->
        <section class="mx-auto max-w-6xl space-y-6 px-4 py-12 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-amber-500">Live listings</p>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Showing {{ $jobs->total() }} openings</h2>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Page {{ $jobs->currentPage() }} · {{ $jobs->count() }} roles on this view
                </p>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                @forelse ($jobs as $job)
                    <article
                        class="group flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-amber-400/60 hover:shadow-xl dark:border-white/10 dark:bg-white/5">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h3
                                    class="text-xl font-semibold text-slate-900 transition group-hover:text-amber-500 dark:text-white">
                                    <a href="{{ route('job.details', ['id' => $job->id]) }}">{{ $job->title }}</a>
                                </h3>
                                <p class="text-sm text-slate-500 dark:text-slate-300">
                                    {{ optional($job->company)->name ?? 'Unknown company' }} ·
                                    {{ optional($job->company)->location ?? 'Remote friendly' }}</p>
                            </div>
                            <span
                                class="rounded-full bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-600 dark:bg-amber-500/20 dark:text-amber-200">{{ ucfirst(str_replace('_', ' ', $job->work_type ?? 'flexible')) }}</span>
                        </div>

                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            {{ \Illuminate\Support\Str::limit($job->description, 150, '…') }}</p>

                        <div class="flex flex-wrap gap-3 text-xs text-slate-500 dark:text-slate-300">
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Posted {{ $job->created_at->diffForHumans() }}
                            </span>
                            @if ($job->deadline)
                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Apply by {{ optional($job->deadline)->format('M d, Y') }}
                                </span>
                            @endif
                            @if ($job->category)
                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-amber-500/10 px-3 py-1 text-amber-600 dark:bg-amber-500/20 dark:text-amber-100">{{ $job->category->name }}</span>
                            @endif
                        </div>

                        <!-- Buttons row -->
                        <div class="flex flex-wrap items-center gap-3 mt-2">
                            @if ($job->salary_min && $job->salary_max)
                                <span
                                    class="text-sm font-semibold text-amber-600 dark:text-amber-200">${{ number_format($job->salary_min, 0) }}
                                    – ${{ number_format($job->salary_max, 0) }}</span>
                            @endif

                            <a href="{{ route('jobs', ['keyword' => $job->title]) }}"
                                class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-amber-500/20 hover:text-amber-600 dark:bg-white/10 dark:text-white dark:hover:bg-amber-500/20">
                                View similar
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>

                            <button type="button"
                                class="apply-btn inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900"
                                data-job-id="{{ $job->id }}">
                                Apply
                            </button>
                        </div>

                    </article>
                @empty
                    <div
                        class="rounded-3xl border border-dashed border-slate-200 bg-white/80 p-12 text-center dark:border-white/20 dark:bg-white/5">
                        <p class="text-lg font-semibold text-slate-900 dark:text-white">No matching jobs right now.</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-300">
                            Adjust your filters or check back soon—new opportunities land every day.
                        </p>
                        <a href="{{ route('jobs') }}"
                            class="mt-5 inline-flex items-center rounded-full bg-slate-900/5 px-6 py-2 text-sm font-semibold text-slate-900 dark:bg-white/10 dark:text-white">
                            Reset filters
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $jobs->links() }}
            </div>
        </section>
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
            toast.className = `fixed bottom-5 right-5 z-50 px-5 py-3 rounded-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
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
    </script>
@endsection
