@extends('layouts.main.app')

@section('content')
    <div class="bg-gradient-to-b from-white via-slate-50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <!-- Hero -->
        <section class="relative overflow-hidden">
            <div class="absolute inset-0" aria-hidden="true">
                <div class="h-full w-full bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.12),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(59,130,246,0.12),_transparent_35%)] dark:bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.35),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(59,130,246,0.25),_transparent_35%)]"></div>
            </div>
            <div class="relative mx-auto flex max-w-6xl flex-col gap-10 px-4 py-16 sm:px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-6">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-emerald-600 dark:bg-white/10 dark:text-emerald-200">
                            Our story
                        </span>
                        <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-5xl">
                            Building hiring experiences that feel human again
                        </h1>
                        <p class="text-base text-slate-600 dark:text-slate-300">
                            HireOn is a distributed team of product thinkers, recruiters, and engineers. We believe the best
                            teams are formed when companies and candidates connect through clarity, compassion, and great
                            workflows—not endless paperwork.
                        </p>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl border border-slate-200 bg-white/90 p-4 text-center dark:border-white/10 dark:bg-white/5">
                                <p class="text-3xl font-bold text-slate-900 dark:text-white">120+</p>
                                <p class="text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400">teams launched</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white/90 p-4 text-center dark:border-white/10 dark:bg-white/5">
                                <p class="text-3xl font-bold text-slate-900 dark:text-white">40k</p>
                                <p class="text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400">candidates matched</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white/90 p-4 text-center dark:border-white/10 dark:bg-white/5">
                                <p class="text-3xl font-bold text-slate-900 dark:text-white">5</p>
                                <p class="text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400">continents</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-white/60 bg-white/70 p-1 shadow-2xl ring-1 ring-black/5 dark:border-white/10 dark:bg-white/5">
                        <img src="{{ asset('about_us/1.jpg') }}" alt="Team session"
                            class="h-full w-full rounded-[26px] object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission -->
        <section class="mx-auto max-w-6xl space-y-10 px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-2">
                <article class="rounded-3xl border border-slate-200 bg-white p-6 dark:border-white/10 dark:bg-white/5">
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Mission</h2>
                    <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">
                        We obsess over reducing friction: every form field, every email template, every interview workflow.
                        Because less friction equals faster hiring and happier teams.
                    </p>
                </article>
                <article class="rounded-3xl border border-slate-200 bg-white p-6 dark:border-white/10 dark:bg-white/5">
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-white">Values</h2>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                        <li>• Craft with empathy</li>
                        <li>• Default to transparency</li>
                        <li>• Ship thoughtfully, learn quickly</li>
                    </ul>
                </article>
            </div>
        </section>

        <!-- Team -->
        <section class="mx-auto max-w-6xl space-y-8 px-4 py-12 sm:px-6 lg:px-8">
            <div class="space-y-3 text-center">
                <p class="text-xs font-semibold uppercase tracking-widest text-emerald-500">Team</p>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Faces behind HireOn</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300">A remote collective of engineers, researchers, and
                    hiring partners.</p>
            </div>

            @php
                $team = [
                    [
                        'name' => 'Ahmed Alaa',
                        'role' => 'Head of Experience',
                        'bio' => 'Full-stack engineer leading our product strategy and mentor program.',
                        'image' => 'about_us/1.jpg',
                        'accent' => 'from-emerald-400/30 via-emerald-500/10 to-transparent',
                    ],
                    [
                        'name' => 'Ahmed Taha',
                        'role' => 'Product Engineering',
                        'bio' => 'Brings polished UI systems to life using modern JavaScript stacks.',
                        'image' => 'about_us/2.jpg',
                        'accent' => 'from-sky-400/30 via-sky-500/10 to-transparent',
                    ],
                    [
                        'name' => 'Saad Safwat',
                        'role' => 'Platform Architect',
                        'bio' => 'Owns our Laravel core and ensures every data flow is reliable.',
                        'image' => 'about_us/3.jpg',
                        'accent' => 'from-purple-400/30 via-purple-500/10 to-transparent',
                    ],
                    [
                        'name' => 'Tasneem Gaballah',
                        'role' => 'Talent Partnerships',
                        'bio' => 'Partners with teams across industries to build meaningful pipelines.',
                        'image' => 'about_us/4.jpg',
                        'accent' => 'from-rose-400/30 via-rose-500/10 to-transparent',
                    ],
                ];
            @endphp

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($team as $member)
                    <article
                        class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5">
                        <div class="flex items-center gap-4">
                            <div class="relative h-16 w-16 overflow-hidden rounded-2xl">
                                <div class="absolute inset-0 bg-gradient-to-br {{ $member['accent'] }}"></div>
                                <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}"
                                    class="relative h-full w-full rounded-2xl object-cover">
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $member['name'] }}</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-300">{{ $member['role'] }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 dark:text-slate-300">{{ $member['bio'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <!-- CTA -->
        <section class="mx-auto max-w-5xl px-4 pb-16 sm:px-6 lg:px-8">
            <div
                class="rounded-3xl border border-emerald-500/40 bg-gradient-to-r from-emerald-500/15 via-emerald-500/5 to-transparent p-8 text-center shadow-lg dark:border-emerald-500/60 dark:from-emerald-500/20 dark:via-emerald-500/10">
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">Ready to build your next team?</h3>
                <p class="mt-3 text-sm text-slate-600 dark:text-slate-300">
                    Whether you need product leaders or entire squads, we’ll help you design a hiring flow that feels
                    effortless.
                </p>
                <a href="{{ route('contact.form') }}"
                    class="mt-6 inline-flex items-center rounded-full bg-emerald-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                    Contact our team
                </a>
            </div>
        </section>
    </div>
@endsection
