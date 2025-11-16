@extends('layouts.main.app')

@section('content')
    @php
        $slidesPayload = collect($heroSlides ?? [])->map(function ($slide) {
            return [
                'title' => $slide['title'] ?? '',
                'subtitle' => $slide['subtitle'] ?? '',
                'image' => asset($slide['image'] ?? 'about_us/1.jpg'),
            ];
        });
    @endphp

    <style>
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .animate-fade-in-up.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes float-slow {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .hero-floating {
            animation: float-slow 4s ease-in-out infinite;
        }
    </style>

    <div
        class="bg-gradient-to-b from-white via-slate-50 to-white text-slate-900 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 dark:text-white">
        <!-- Hero -->
        <section x-data="homeHero({{ $slidesPayload->toJson() }})" x-init="start()" class="relative isolate overflow-hidden">
            <div class="absolute inset-0" aria-hidden="true">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="active === index" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-500"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute inset-0 bg-cover bg-center"
                        :style="`background-image: linear-gradient(120deg, rgba(15,23,42,0.65), rgba(15,23,42,0.85)), url('${slide.image}')`">
                    </div>
                </template>
            </div>

            <div class="relative mx-auto max-w-6xl px-4 py-16 sm:py-20 lg:py-28">
                <div class="max-w-3xl space-y-6 text-white">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-wide text-amber-200 backdrop-blur">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Hiring made human
                    </span>
                    <h1 class="text-3xl font-bold leading-tight sm:text-5xl lg:text-6xl">
                        <span x-text="slides[active]?.title"></span>
                    </h1>
                    <p class="text-base text-white/80 sm:text-lg" x-text="slides[active]?.subtitle"></p>

                    <div class="hero-floating rounded-3xl bg-white/10 p-6 shadow-xl backdrop-blur-md dark:bg-white/5">
                        <form action="{{ route('jobs') }}" method="GET"
                            class="grid gap-4 md:grid-cols-[2fr_1.5fr_1.5fr_auto]">
                            <label class="flex flex-col gap-2 text-sm text-white/80">
                                <span class="font-semibold text-white">Role or keyword</span>
                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                    placeholder="e.g. Product Designer"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 dark:border-white/20 dark:bg-white/10 dark:text-white dark:placeholder:text-white/60">
                            </label>
                            <label class="flex flex-col gap-2 text-sm text-white/80">
                                <span class="font-semibold text-white">Location</span>
                                <input type="text" name="location" value="{{ request('location') }}"
                                    placeholder="City, Country"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 dark:border-white/20 dark:bg-white/10 dark:text-white dark:placeholder:text-white/60">
                            </label>
                            <label class="flex flex-col gap-2 text-sm text-white/80">
                                <span class="font-semibold text-white">Category</span>
                                <select name="category_id"
                                    class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30 dark:border-white/20 dark:bg-white/10 dark:text-white">
                                    <option value="" class="text-gray-900 dark:text-gray-900">All categories</option>
                                    @foreach ($categoryOptions as $category)
                                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)
                                            class="text-gray-900 dark:text-gray-900">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <button type="submit"
                                class="mt-auto inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900">
                                Search jobs
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-wrap gap-4 text-sm text-white/80">
                        <div class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 backdrop-blur">
                            <span class="text-lg font-semibold text-white">{{ number_format($stats['approved_jobs']) }}</span>
                            <span>approved roles</span>
                        </div>
                        <div class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 backdrop-blur">
                            <span class="text-lg font-semibold text-white">{{ number_format($stats['applications_accepted']) }}</span>
                            <span>applications submitted</span>
                        </div>
                        <div class="flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 backdrop-blur">
                            <span class="text-lg font-semibold text-white">{{ number_format($stats['applications_total']) }}</span>
                            <span>total applications</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="animate-fade-in-up px-4 py-16 md:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl">
                <div class="mb-8 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Discover roles by category</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-300">Explore the most active fields and jump
                            straight into matching vacancies.</p>
                    </div>
                    <a href="{{ route('jobs') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-500 dark:text-amber-300 dark:hover:text-amber-200">
                        Browse all jobs
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @forelse ($topCategories as $category)
                        <a href="{{ route('jobs', ['category_id' => $category->id]) }}"
                            class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-amber-400/60 hover:bg-amber-50 dark:border-white/10 dark:bg-white/5 dark:hover:bg-amber-500/10">
                            <div class="flex h-full flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-semibold text-slate-900 dark:text-white">{{ $category->name }}
                                    </div>
                                    <span
                                        class="rounded-full bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-700 dark:bg-amber-500/20 dark:text-amber-200 whitespace-nowrap">{{ $category->jobs_count ?? 0 }}
                                        Roles</span>
                                </div>
                                <p class="flex-1 text-sm text-slate-500 dark:text-slate-300">See curated openings tailored
                                    to this expertise.</p>
                                <span
                                    class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600 dark:text-amber-200">
                                    View jobs
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transition group-hover:translate-x-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @empty
                        <div
                            class="col-span-full rounded-3xl border border-slate-200 bg-white p-6 text-center text-slate-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                            Categories coming soon.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Featured Jobs -->
        <section class="animate-fade-in-up px-4 py-16 md:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl space-y-8">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Featured roles</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-300">Handpicked opportunities with exceptional
                            teams and growth paths.</p>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ($featuredJobs as $job)
                        <article
                            class="group flex h-full flex-col justify-between rounded-3xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:border-amber-400/60 hover:bg-amber-50 dark:border-white/10 dark:bg-white/5 dark:hover:bg-amber-500/10">
                            <div class="space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-xl font-semibold text-slate-900 dark:text-white">
                                            <a href="{{ route('job.details', ['id' => $job->id]) }}"
                                                class="hover:text-amber-500 transition">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-300">
                                            {{ optional($job->company)->name ?? 'Unknown company' }}</p>
                                    </div>
                                    <span
                                        class="rounded-full bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-700 dark:bg-amber-500/20 dark:text-amber-200">{{ ucfirst(str_replace('_', ' ', $job->work_type)) }}</span>
                                </div>
                                <p class="line-clamp-3 text-sm text-slate-500 dark:text-slate-300">
                                    {{ \Illuminate\Support\Str::limit($job->description, 150) }}
                                </p>
                            </div>

                            <div class="mt-6 flex flex-wrap items-center gap-3 justify-between text-xs text-slate-500 dark:text-slate-300">
                                @if ($job->salary_min && $job->salary_max)
                                    <span class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">
                                        ${{ number_format($job->salary_min, 0) }} –
                                        ${{ number_format($job->salary_max, 0) }}
                                    </span>
                                @endif
                                @if ($job->deadline)
                                    <span class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">
                                        Apply by {{ $job->deadline->format('M d, Y') }}
                                    </span>
                                @endif
                                @if ($job->category)
                                    <span class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">
                                        {{ $job->category->name }}
                                    </span>
                                @endif
                                @if(auth()->check())
                                    @if(in_array($job->id, $userAppliedJobs))
                                        <button type="button"
                                            class="inline-flex items-center justify-center rounded-2xl bg-green-500 px-4 py-2 text-sm font-semibold text-white cursor-not-allowed"
                                            disabled>
                                            Applied
                                        </button>
                                    @else
                                    @can('candidate-view')
                                    <button type="button"
                                    class="apply-btn inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950
                                    transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300
                                    focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900"
                                    data-job-id="{{ $job->id }}">
                                    Apply
                                </button>
                                @endcan
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950
                                        transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300
                                        focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900">
                                        Login to Apply
                                    </a>
                                @endif


                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Latest Jobs -->
        <section class="animate-fade-in-up px-4 pb-20 md:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl space-y-8">
                <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Latest opportunities</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-300">Fresh listings from teams that are actively
                            interviewing right now.</p>
                    </div>
                    <a href="{{ route('jobs') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-500 dark:text-amber-300 dark:hover:text-amber-200">
                        See all openings
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <div class="grid gap-4">
                    @foreach ($latestJobs as $job)
                        <article
                            class="flex flex-col gap-3 rounded-3xl border border-slate-200 bg-white p-5 transition hover:-translate-y-1 hover:border-amber-400/60 hover:bg-amber-50 dark:border-white/10 dark:bg-white/5 dark:hover:bg-amber-500/10 md:flex-row md:items-center md:justify-between">
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/10 text-amber-600 dark:bg-amber-500/15 dark:text-amber-200">
                                        {{ strtoupper(substr($job->title, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                            <a href="{{ route('job.details', ['id' => $job->id]) }}"
                                                class="hover:text-amber-500 transition">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-300">
                                            {{ optional($job->company)->name ?? 'Unknown company' }} ·
                                            {{ optional($job->company)->location ?? 'Remote friendly' }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 text-xs text-slate-500 dark:text-slate-300">
                                    <span
                                        class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">{{ ucfirst(str_replace('_', ' ', $job->work_type)) }}</span>
                                    @if ($job->category)
                                        <span
                                            class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">{{ $job->category->name }}</span>
                                    @endif
                                    <span class="rounded-full bg-slate-900/5 px-3 py-1 dark:bg-white/10">Posted
                                        {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                @if ($job->salary_min && $job->salary_max)
                                    <span class="text-sm font-semibold text-amber-600 dark:text-amber-200">
                                        ${{ number_format($job->salary_min, 0) }} –
                                        ${{ number_format($job->salary_max, 0) }}
                                    </span>
                                @endif
                                @if(auth()->check())
                                    @if(in_array($job->id, $userAppliedJobs))
                                        <button type="button"
                                            class="inline-flex items-center justify-center rounded-2xl bg-green-500 px-4 py-2 text-sm font-semibold text-white cursor-not-allowed"
                                            disabled>
                                            Applied
                                        </button>
                                    @else
                                    @can('candidate-view')
                                    <button type="button"
                                    class="apply-btn inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950
                                    transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300
                                    focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900"
                                    data-job-id="{{ $job->id }}">
                                    Apply
                                </button>
                                @endcan
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950
                                        transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300
                                        focus:ring-offset-2 focus:ring-offset-slate-100 dark:focus:ring-offset-slate-900">
                                        Login to Apply
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
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

        // Function to show toast
        function showToast(type, message) {
            const toast = document.createElement('div');
            toast.textContent = message;
            toast.className = `fixed bottom-5 right-5 z-50 px-5 py-3 rounded-lg text-white shadow-lg transition-opacity duration-500 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } opacity-0`;
            document.body.appendChild(toast);

            // Force browser to render before adding opacity-100
            requestAnimationFrame(() => toast.classList.add('opacity-100'));

            setTimeout(() => {
                toast.classList.remove('opacity-100');
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
                                button.textContent = 'Applied';
                                button.classList.remove('bg-amber-500', 'hover:bg-amber-400');
                                button.classList.add('bg-green-500', 'cursor-not-allowed');
                                button.disabled = true;
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
    </script>
@endsection
