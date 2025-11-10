<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/hireon-logo.svg') }}">

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <script>
            (() => {
                try {
                    const storedTheme = localStorage.getItem('theme');
                    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const shouldUseDark = storedTheme === 'dark' || (!storedTheme && systemPrefersDark);

                    document.documentElement.classList.toggle('dark', shouldUseDark);
                    document.documentElement.style.colorScheme = shouldUseDark ? 'dark' : 'light';
                } catch (error) {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.style.colorScheme = 'light';
                }
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="m-0 min-h-screen bg-white font-sans antialiased text-slate-900 dark:bg-slate-950 dark:text-slate-50">

        <div class="relative min-h-screen">
            <div class="relative flex min-h-screen flex-col lg:flex-row">
                <aside class="relative flex w-full flex-col gap-10 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 px-6 pt-6 pb-10 text-slate-100 lg:max-w-xl lg:px-10 lg:pt-8 xl:px-14">
                    <header class="flex items-center justify-between">
                        <a href="{{ route('home') }}" class="group inline-flex items-center gap-3">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/5 ring-1 ring-white/15 transition group-hover:bg-white/10">
                                <img src="{{ asset('images/app-logo.png') }}" alt="{{ config('app.name') }} logo" class="h-9 w-9">
                            </span>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.55em] text-amber-200/90">
                                    {{ config('app.name', 'Hireon') }}
                                </p>
                                <p class="text-sm text-white/70">Careers platform for high-growth teams</p>
                            </div>
                        </a>

                        <a href="{{ route('jobs') }}" class="inline-flex items-center gap-2 rounded-full border border-white/15 px-5 py-2 text-xs font-semibold uppercase tracking-[0.35em] text-white/80 transition hover:border-amber-300 hover:text-amber-200">
                            Browse roles
                            <svg viewBox="0 0 24 24" class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </a>
                    </header>

                    <div class="space-y-6">
                        <p class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.35em] text-amber-200">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-300 animate-pulse"></span>
                            Human-first hiring
                        </p>
                        <h1 class="text-3xl font-semibold leading-tight text-white sm:text-4xl">
                            Build your career narrative with curated opportunities and smart profile tooling.
                        </h1>
                        <p class="text-base text-white/70">
                            Tap into vetted startups and enterprise teams, keep your credentials synced through LinkedIn,
                            and collaborate with hiring managers inside one responsive dashboard.
                        </p>
                    </div>

                    <dl class="grid gap-6 sm:grid-cols-3">
                        <div>
                            <dt class="text-sm text-white/60">Active openings</dt>
                            <dd class="text-3xl font-semibold text-white">3.8k</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-white/60">Avg. match score</dt>
                            <dd class="text-3xl font-semibold text-white">92%</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-white/60">Hires / month</dt>
                            <dd class="text-3xl font-semibold text-white">1,200+</dd>
                        </div>
                    </dl>

                    <div class="space-y-4 rounded-3xl border border-white/10 bg-white/5 p-5 shadow-2xl shadow-black/25 backdrop-blur">
                        <div class="flex items-center gap-4">
                            <img src="https://avatars.githubusercontent.com/u/104958?s=64" alt="Candidate portrait" class="h-12 w-12 rounded-2xl border border-white/20 object-cover">
                            <div>
                                <p class="text-sm font-medium text-white">Sahar Mahmoud</p>
                                <p class="text-xs text-white/70">Product Lead @ Devnode</p>
                            </div>
                        </div>
                        <p class="text-sm text-white/80">
                            "Hireon's LinkedIn sync and collaborative shortlist let our team close roles 40% faster.
                            It feels like a white-glove talent partner."
                        </p>
                    </div>

                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-[0.4em] text-white/60">Trusted by teams at</p>
                        <div class="flex flex-wrap gap-3 text-xs font-semibold text-white/70">
                            <span class="rounded-full border border-white/10 px-3 py-1">Invision</span>
                            <span class="rounded-full border border-white/10 px-3 py-1">Swvl</span>
                            <span class="rounded-full border border-white/10 px-3 py-1">Vodafone</span>
                            <span class="rounded-full border border-white/10 px-3 py-1">Raya</span>
                        </div>
                    </div>
                </aside>

                <main class="flex flex-1 items-center justify-center bg-gradient-to-b from-white via-white to-slate-50 px-4 pt-6 pb-12 text-slate-900 dark:from-slate-950 dark:via-slate-950 dark:to-slate-950 dark:text-slate-50 sm:px-6 lg:px-12 lg:pt-8">
                    <div class="w-full max-w-lg">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
