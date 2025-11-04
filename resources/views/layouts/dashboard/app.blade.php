<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="dashboard()" x-init="init()"
    class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>{{ $title ?? 'HireOn Dashboard' }}</title>

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script>
        (() => {
            try {
                const storedTheme = localStorage.getItem('theme');
                const legacyTheme = localStorage.getItem('darkMode');
                let shouldUseDark = false;

                if (storedTheme === 'dark' || storedTheme === 'light') {
                    shouldUseDark = storedTheme === 'dark';
                } else if (legacyTheme !== null) {
                    shouldUseDark = legacyTheme === 'true';
                    localStorage.setItem('theme', shouldUseDark ? 'dark' : 'light');
                    localStorage.removeItem('darkMode');
                } else {
                    shouldUseDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                }

                document.documentElement.classList.toggle('dark', shouldUseDark);
                document.documentElement.style.colorScheme = shouldUseDark ? 'dark' : 'light';
            } catch (error) {
                document.documentElement.classList.remove('dark');
                document.documentElement.style.colorScheme = 'light';
            }
        })();
    </script>
</head>

<body :class="{ 'dark': darkMode }"
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased selection:bg-indigo-200/60 dark:selection:bg-indigo-600/40">
    <a href="#main"
        class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white dark:bg-gray-800 text-sm px-3 py-2 rounded shadow">Skip
        to content</a>

    <div class="min-h-screen flex">
        <!-- Sidebar (Desktop) -->
        <aside
            class="hidden md:flex flex-col border-r border-gray-200/80 dark:border-gray-800 bg-white/90 dark:bg-gray-900/60 backdrop-blur supports-[backdrop-filter]:bg-white/70 dark:supports-[backdrop-filter]:bg-gray-900/40 transition-[width] duration-300 ease-in-out"
            :class="(sidebarOpen || hoverOpen) ? 'w-72' : 'w-20'" @mouseenter="hoverOpen = false"
            @mouseleave="hoverOpen = false">
            <!-- Brand / Collapse -->
            <div class="flex items-center justify-between px-4 h-16">
                <a href="{{ route('dashboard.home') }}" class="flex items-center gap-2 group">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white font-bold shadow-md">H</span>
                    <span x-show="(sidebarOpen || hoverOpen)" x-transition.opacity
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }"
                        class="text-lg font-semibold tracking-tight">
                        HireOn
                    </span>
                </a>
                <button @click="toggleSidebar()"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    :aria-expanded="sidebarOpen.toString()" :title="sidebarOpen ? 'Collapse' : 'Expand'">
                    <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                    <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Nav -->
            <nav class="px-2 py-4 space-y-1 overflow-y-auto overflow-x-hidden">
                @php($active = fn($name) => request()->routeIs($name) ? 'bg-indigo-600/10 text-indigo-700 dark:text-indigo-300 ring-1 ring-inset ring-indigo-600/20' : 'hover:bg-gray-100 dark:hover:bg-gray-800')

                <!-- Dashboard -->
                <a href="{{ route('dashboard.home') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2 rounded-xl transition {{ $active('dashboard.home') }}"
                    :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                    :title="!(sidebarOpen || hoverOpen) ? 'Dashboard' : ''">
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    <span x-show="(sidebarOpen || hoverOpen)" x-transition.opacity
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Dashboard</span>
                </a>

                <!-- Jobs -->
                <a href="{{ route('dashboard.jobs') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2 rounded-xl transition {{ $active('dashboard.jobs') }}"
                    :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                    :title="!(sidebarOpen || hoverOpen) ? 'Jobs' : ''">
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7a2 2 0 012-2h12a2 2 0 012 2v3H4V7zm0 3v7a2 2 0 002 2h12a2 2 0 002-2v-7" />
                    </svg>
                    <span x-show="(sidebarOpen || hoverOpen)" x-transition.opacity
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Jobs</span>
                </a>

                <!-- Applications -->
                <a href="{{ route('dashboard.applications') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2 rounded-xl transition {{ $active('dashboard.applications') }}"
                    :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                    :title="!(sidebarOpen || hoverOpen) ? 'Applications' : ''">
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
                    </svg>
                    <span x-show="(sidebarOpen || hoverOpen)" x-transition.opacity
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Applications</span>
                </a>

                <!-- Profile -->
                <a href="{{ route('dashboard.profile') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2 rounded-xl transition {{ $active('dashboard.profile') }}"
                    :class="(sidebarOpen || hoverOpen) ? 'justify-start' : 'justify-center'"
                    :title="!(sidebarOpen || hoverOpen) ? 'Profile' : ''">
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0" />
                    </svg>
                    <span x-show="(sidebarOpen || hoverOpen)" x-transition.opacity
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Profile</span>
                </a>

                <div class="mx-4 my-3 border-t border-gray-200 dark:border-gray-800"></div>
            </nav>

            <!-- Footer in sidebar -->
            <div class="mt-auto p-4">
                <div class="text-xs text-gray-500 dark:text-gray-400">v{{ config('app.version', '1.0.0') }}</div>
            </div>
        </aside>

        <!-- Mobile Sidebar (Slide-over) -->
        <div class="md:hidden">
            <div x-show="mobileMenuOpen" x-transition.opacity class="fixed inset-0 z-40 bg-black/40"
                @click="mobileMenuOpen=false" aria-hidden="true"></div>
            <aside x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 p-4">
                <div class="flex items-center justify-between h-12">
                    <span class="text-lg font-semibold">Menu</span>
                    <button @click="mobileMenuOpen=false"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <nav class="mt-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard.home') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Jobs -->
                    <a href="{{ route('dashboard.jobs') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7a2 2 0 012-2h12a2 2 0 012 2v3H4V7zm0 3v7a2 2 0 002 2h12a2 2 0 002-2v-7" />
                        </svg>
                        <span>Jobs</span>
                    </a>

                    <!-- Applications -->
                    <a href="{{ route('dashboard.applications') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
                        </svg>
                        <span>Applications</span>
                    </a>

                    <!-- Profile -->
                    <a href="{{ route('dashboard.profile') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </nav>
            </aside>
        </div>

        <!-- Main -->
        <div class="flex-1 min-w-0 flex flex-col">
            <!-- Top Bar -->
            <header
                class="sticky top-0 z-30 bg-white/80 dark:bg-gray-900/70 backdrop-blur border-b border-gray-200/80 dark:border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800"
                            @click="mobileMenuOpen = true" aria-label="Open menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-base sm:text-lg font-semibold tracking-tight">{{ $pageTitle ?? 'Dashboard' }}
                        </h1>
                        <nav aria-label="Breadcrumb"
                            class="hidden sm:block ml-3 text-sm text-gray-500 dark:text-gray-400">
                            {{ $breadcrumb ?? '' }}
                        </nav>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <button @click="toggleTheme()"
                            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900/0"
                            :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                            :aria-pressed="darkMode.toString()">
                            <svg x-show="!darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                            <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                            </svg>
                        </button>

                        <!-- Notifications -->
                        <div class="relative" x-data="{ open: false }" @keydown.escape="open=false">
                            <button @click="open=!open"
                                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute -top-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            </button>
                            <div x-show="open" x-transition @click.outside="open=false"
                                class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-xl overflow-hidden">
                                <div
                                    class="px-4 py-2 text-sm font-medium border-b border-gray-200 dark:border-gray-800">
                                    Notifications</div>
                                <div class="divide-y divide-gray-200/70 dark:divide-gray-800">
                                    <a href="#"
                                        class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800">No new
                                        notifications</a>
                                </div>
                            </div>
                        </div>

                        <!-- User -->
                        <div class="relative" x-data="{ open: false }" @keydown.escape="open=false">
                            <button @click="open=!open"
                                class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800">
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                                <span class="hidden sm:block text-sm">{{ auth()->user()->name ?? 'Ahmed' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-70"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 9l6 6 6-6" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition @click.outside="open=false"
                                class="absolute right-0 mt-2 w-52 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-xl overflow-hidden">
                                <a href="{{ route('dashboard.profile') }}"
                                    class="block px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-800">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-800">Log
                                        out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main id="main" class="flex-1">
                <section class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
                    @isset($starter)
                        {{ $starter }}
                    @else
                        <div class="mt-6">
                            @yield('content')
                        </div>
                    @endisset
                </section>
            </main>

            <!-- Footer -->
            <footer class="border-t border-gray-200/80 dark:border-gray-800 py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} HireOn. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <script>
        function dashboard() {
            return {
                sidebarOpen: true,
                hoverOpen: false, // NEW: temporary expand on hover
                mobileMenuOpen: false,
                darkMode: false,
                hasStoredTheme: false,
                mediaQuery: null,
                init() {
                    // Sidebar state persistence
                    const savedSidebar = localStorage.getItem('sidebarOpen');
                    this.sidebarOpen = savedSidebar !== null ? savedSidebar === 'true' : true;

                    // Theme: prefer saved, else prefers-color-scheme
                    const storedTheme = localStorage.getItem('theme');
                    const legacyTheme = localStorage.getItem('darkMode');

                    if (storedTheme === 'dark' || storedTheme === 'light') {
                        this.darkMode = storedTheme === 'dark';
                        this.hasStoredTheme = true;
                    } else if (legacyTheme !== null) {
                        this.darkMode = legacyTheme === 'true';
                        this.hasStoredTheme = true;
                        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                        localStorage.removeItem('darkMode');
                    } else {
                        this.darkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                    this.applyTheme();

                    this.$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value));

                    this.mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                    const syncSystemPreference = event => {
                        if (this.hasStoredTheme) {
                            return;
                        }

                        this.darkMode = event.matches;
                        this.applyTheme();
                    };

                    if (typeof this.mediaQuery.addEventListener === 'function') {
                        this.mediaQuery.addEventListener('change', syncSystemPreference);
                    } else if (typeof this.mediaQuery.addListener === 'function') {
                        this.mediaQuery.addListener(syncSystemPreference);
                    }
                },
                toggleTheme() {
                    this.darkMode = !this.darkMode;
                    this.hasStoredTheme = true;
                    this.applyTheme();
                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                },
                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },
                applyTheme() {
                    document.documentElement.classList.toggle('dark', this.darkMode);
                    document.documentElement.style.colorScheme = this.darkMode ? 'dark' : 'light';
                }
            }
        }
    </script>

</body>

</html>
