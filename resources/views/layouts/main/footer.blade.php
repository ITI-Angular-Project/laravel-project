@php
    $primaryFooterLinks = [
        ['label' => 'Home', 'href' => route('home')],
        ['label' => 'Jobs', 'href' => route('jobs')],
        ['label' => 'About', 'href' => route('about')],
        ['label' => 'Contact', 'href' => route('contact.form')],
    ];

@endphp

<footer
    class="relative overflow-hidden border-t border-amber-100/80 dark:border-amber-500/20 bg-gradient-to-b from-white via-amber-50/40 to-white dark:from-slate-950 dark:via-slate-900 dark:to-black text-slate-600 dark:text-slate-200 py-10">
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-400/60 to-transparent"></div>
    <div class="absolute -top-16 right-6 w-48 h-48 rounded-full bg-amber-500/10 dark:bg-amber-400/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full bg-amber-300/10 dark:bg-amber-500/5 blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-4">
        <div class="text-center space-y-6">

            <!-- Logo/Brand -->
            <div class="mb-4">
                <h2
                    class="text-2xl font-semibold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-amber-700 via-orange-600 to-amber-500 dark:from-amber-200 dark:via-amber-300 dark:to-yellow-200 drop-shadow">
                    {{ env('APP_NAME') }}
                </h2>
            </div>

            <!-- Links -->
            <div class="flex flex-col gap-2">
                <nav class="flex flex-wrap justify-center items-center gap-4 text-sm">
                    @foreach ($primaryFooterLinks as $link)
                        <a href="{{ $link['href'] }}"
                            class="text-slate-600 hover:text-amber-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 rounded px-1 dark:text-slate-300 dark:hover:text-amber-200 transition">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    @auth
                        @canAny(['admin-view', 'employer-view'])
                            <a href="{{ route('dashboard.home') }}"
                                class="text-slate-600 hover:text-amber-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 rounded px-1 dark:text-slate-300 dark:hover:text-amber-200 transition">
                                Dashboard
                            </a>
                        @endcan
                    @endauth
                </nav>
            </div>

            <!-- Social Icons Removed -->

            <!-- Copyright -->
            <div class="border-t border-amber-100/80 dark:border-white/10 pt-4">
                <p class="text-sm text-slate-600 dark:text-slate-300">
                    &copy; {{ date('Y') }} <span
                        class="font-semibold text-slate-900 dark:text-white">{{ env('APP_NAME', 'JobBoard') }}</span>. All rights
                    reserved.
                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Made with <span class="text-amber-600 dark:text-amber-300">♥</span> for job seekers worldwide
                </p>
            </div>

        </div>
    </div>
</footer>
