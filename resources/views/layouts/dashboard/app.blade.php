@php
$flashToasts = array_values(
    array_filter(
        [
            ['type' => 'success', 'message' => session('success')],
            ['type' => 'error', 'message' => session('error')],
            ['type' => 'warning', 'message' => session('warning')],
            ['type' => 'info', 'message' => session('status')],
        ],
        fn($toast) => filled($toast['message']),
    ),
);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="dashboard()" x-init="init()"
    class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/hireon-logo.svg') }}">
    <title>{{ $title ?? 'HireOn Dashboard' }}</title>

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important
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
    class="bg-amber-50/60 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased selection:bg-amber-200/60 dark:selection:bg-amber-600/40">
    <a href="#main"
        class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-white dark:bg-gray-800 text-sm px-3 py-2 rounded shadow">
        Skip to content
    </a>

    <x-ui.toast-stack />

    <div class="min-h-screen flex">
        <!-- Sidebar (Desktop) -->
        <aside
            class="hidden md:flex flex-col border-r border-amber-100/80 dark:border-gray-800 bg-white dark:bg-gray-900 transition-all duration-300 ease-in-out shadow-sm"
            :class="sidebarOpen ? 'w-72' : 'w-20'">

            <!-- Brand / Collapse -->
            <div
                class="flex items-center justify-between px-4 h-16 border-b border-amber-100/60 dark:border-gray-800/50">
                <a href="{{ route('dashboard.home') }}"
                    class="flex items-center gap-2 group transition-transform duration-200 hover:scale-105">
                    <x-application-logo class="h-9 w-9 flex-shrink-0" />
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }"
                        class="text-lg font-semibold tracking-tight text-amber-800 dark:text-white">HireOn</span>
                </a>
                <button @click="toggleSidebar()"
                    class="p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all duration-200 hover:scale-110"
                    :aria-expanded="sidebarOpen.toString()" :title="sidebarOpen ? 'Collapse' : 'Expand'">
                    <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                    <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Nav -->
            <nav class="px-2 py-4 space-y-1 overflow-y-auto overflow-x-hidden">
                @php($active = fn($name) => request()->routeIs($name) ? 'bg-amber-600/10 text-amber-700 dark:text-amber-300 ring-1 ring-inset ring-amber-600/20' : 'hover:bg-gray-100 dark:hover:bg-gray-800')

                <!-- Dashboard -->
                <a href="{{ route('dashboard.home') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $active('dashboard.home') }} hover:scale-[1.02]"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center'" :title="!sidebarOpen ? 'Dashboard' : ''"
                    @if (request()->routeIs('dashboard.home')) aria-current="page" @endif>
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100 transition-all duration-200 group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Dashboard</span>
                </a>

                <!-- Jobs -->
                <a href="{{ route('dashboard.jobs.index') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $active('dashboard.jobs.*') }} hover:scale-[1.02]"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center'" :title="!sidebarOpen ? 'Jobs' : ''"
                    @if (request()->routeIs('dashboard.jobs')) aria-current="page" @endif>
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100 transition-all duration-200 group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    @can('admin-view')
                        <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Jobs</span>
                    @else
                        <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-x-2"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">My Jobs</span>
                    @endcan
                </a>

                <!-- Applications -->
                <a href="{{ route('dashboard.applications.index') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $active('dashboard.applications.*') }} hover:scale-[1.02]"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center'"
                    :title="!sidebarOpen ? 'Applications' : ''"
                    @if (request()->routeIs('dashboard.applications.index')) aria-current="page" @endif>
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100 transition-all duration-200 group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Applications</span>
                </a>

                <!-- Profile -->
                <a href="{{ route('dashboard.profile') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $active('dashboard.profile') }} hover:scale-[1.02]"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center'" :title="!sidebarOpen ? 'Profile' : ''"
                    @if (request()->routeIs('dashboard.profile')) aria-current="page" @endif>
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100 transition-all duration-200 group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Profile</span>
                </a>

                <!-- Users -->
                <a href="{{ route('dashboard.users.index') }}"
                    class="group relative flex items-center gap-3 mx-2 px-3 py-2.5 rounded-xl transition-all duration-200 {{ $active('dashboard.users.*') }} hover:scale-[1.02]"
                    :class="sidebarOpen ? 'justify-start' : 'justify-center'" :title="!sidebarOpen ? 'Users' : ''"
                    @if (request()->routeIs('dashboard.users.*')) aria-current="page" @endif>
                    <svg class="h-5 w-5 opacity-80 group-hover:opacity-100 transition-all duration-200 group-hover:scale-110"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-2"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        :class="{ 'opacity-0 pointer-events-none': !sidebarOpen }">Users</span>
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
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" aria-label="Close menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <nav class="mt-4 space-y-1">
                    <a href="{{ route('dashboard.home') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('dashboard.home') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('dashboard.jobs.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('dashboard.jobs') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7a2 2 0 012-2h12a2 2 0 012 2v3H4V7zm0 3v7a2 2 0 002 2h12a2 2 0 002-2v-7" />
                        </svg>
                        @can('admin-view')
                            <span>Jobs</span>
                        @else
                            <span>My Jobs</span>
                        @endcan
                    </a>

                    <a href="{{ route('dashboard.applications.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('dashboard.applications') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
                        </svg>
                        <span>Applications</span>
                    </a>

                    <a href="{{ route('dashboard.profile') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('dashboard.profile') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 0114 0" />
                        </svg>
                        <span>Profile</span>
                    </a>

                    <a href="{{ route('dashboard.users.index') }}"
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('dashboard.users.*') ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                        <svg class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        <span>Users</span>
                    </a>
                </nav>
            </aside>
        </div>

        <!-- Main -->
        <div class="flex-1 min-w-0 flex flex-col">
            <!-- Top Bar -->
            <header
                class="sticky top-0 z-30 bg-white/90 dark:bg-gray-900/90 backdrop-blur border-b border-amber-100/60 dark:border-gray-800/60">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <button
                            class="md:hidden p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-gray-800 transition-all duration-200 hover:scale-110"
                            @click="mobileMenuOpen = true" aria-label="Open menu">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h1 class="text-base sm:text-lg font-semibold tracking-tight text-amber-800 dark:text-white">
                            {{ $pageTitle ?? 'Dashboard' }}</h1>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('dashboard.jobs.create') }}"
                            class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium transition">Post
                            a Job</a>

                        <button @click="toggleTheme()"
                            class="p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-gray-800 active:outline-none active:ring-2 active:ring-amber-500 active:ring-offset-2 active:ring-offset-gray-900/0 transition-all duration-200 hover:scale-110 hover:rotate-12"
                            :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                            :aria-pressed="darkMode.toString()">
                            <svg x-show="!darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                            <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                            </svg>
                        </button>

                        <!-- Notifications (kept minimal) -->
                        <div class="relative"
                            x-data="notificationDropdown({{ auth()->user()?->unreadNotifications()->count() ? 'true' : 'false' }})"
                            @keydown.escape="open=false">
                            <button @click="toggle()"
                                class="p-2 rounded-lg hover:bg-amber-50 dark:hover:bg-gray-800 relative transition-all duration-200 hover:scale-110"
                                aria-haspopup="true" :aria-expanded="open.toString()"
                                aria-label="Open notifications">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>

                                {{-- Red dot if unread notifications exist --}}
                                <span x-show="hasUnread"
                                    class="absolute -top-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            </button>

                            {{-- Dropdown --}}
                            <div x-cloak x-show="open" x-transition @click.outside="open=false"
                                class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-xl overflow-hidden z-50">
                                <div
                                    class="px-4 py-2 text-sm font-medium border-b border-gray-200 dark:border-gray-800">
                                    Notifications
                                </div>

                                <div class="divide-y divide-gray-200/70 dark:divide-gray-800 max-h-80 overflow-y-auto">
                                    @forelse($notifications as $notification)
                                        <a href="{{ $notification->data['url'] ?? '#' }}"
                                            class="block px-4 py-3 text-sm hover:bg-gray-50 dark:hover:bg-gray-800">
                                            <div class="font-semibold text-gray-800 dark:text-gray-200">
                                                {{ $notification->data['title'] ?? 'Notification' }}
                                            </div>
                                            <div class="text-gray-500 dark:text-gray-400 text-xs">
                                                {{ $notification->data['message'] ?? '' }}
                                            </div>
                                            <div class="text-xs text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </a>
                                    @empty
                                        <span class="block px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                            No new notifications
                                        </span>
                                    @endforelse
                                </div>

                                @if (auth()->user()?->notifications()->count() > 5)
                                    <div
                                        class="text-center py-2 text-xs border-t border-gray-200 dark:border-gray-800">
                                        <a href="{{ route('dashboard.notifications.index') }}"
                                            class="text-emerald-600 dark:text-emerald-400 hover:underline">View all</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- User -->
                        <div class="relative" x-data="{ open: false }" @keydown.escape="open=false">
                            <button @click="open=!open"
                                class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-xl hover:bg-amber-50 dark:hover:bg-gray-800 transition-all duration-200 hover:scale-105"
                                aria-haspopup="true" :aria-expanded="open.toString()">
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-amber-600 text-white text-sm font-semibold"
                                    aria-hidden="true">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                </span>
                                <span
                                    class="hidden sm:block text-sm font-medium">{{ auth()->user()->name ?? 'Ahmed' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 opacity-70 transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 9l6 6 6-6" />
                                </svg>
                            </button>
                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-1" @click.outside="open=false"
                                class="absolute right-0 mt-2 w-52 bg-white dark:bg-gray-900 border border-amber-100 dark:border-gray-800 rounded-xl shadow-xl overflow-hidden backdrop-blur-xl">
                                <a href="{{ route('home') }}"
                                    class="block px-4 py-2 text-sm hover:bg-amber-50 dark:hover:bg-gray-800 transition-all duration-200">Home</a>
                                <a href="{{ route('dashboard.profile') }}"
                                    class="block px-4 py-2 text-sm hover:bg-amber-50 dark:hover:bg-gray-800 transition-all duration-200">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200">Log
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
                        <div class="mt-6 animate-in fade-in duration-300">
                            @yield('content')
                        </div>
                    @endisset
                </section>
            </main>

            <!-- Footer -->
            <footer
                class="border-t border-gray-200/60 dark:border-gray-800/60 bg-gradient-to-r from-white/50 via-white/80 to-white/50 dark:from-gray-900/50 dark:via-gray-900/80 dark:to-gray-900/50 backdrop-blur-sm py-4">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-500 dark:text-gray-400">
                    &copy; {{ date('Y') }} HireOn. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <script>
        function dashboard() {
            const flashToasts = @json($flashToasts);
            const toastStylesMap = {
                success: 'border-amber-200/80 dark:border-amber-800/60 bg-amber-50/90 dark:bg-amber-900/40 text-amber-900 dark:text-amber-100',
                error: 'border-rose-200/80 dark:border-rose-800/60 bg-rose-50/90 dark:bg-rose-900/40 text-rose-900 dark:text-rose-100',
                warning: 'border-amber-200/80 dark:border-amber-800/60 bg-amber-50/90 dark:bg-amber-900/40 text-amber-900 dark:text-amber-100',
                info: 'border-sky-200/80 dark:border-sky-800/60 bg-sky-50/90 dark:bg-sky-900/40 text-sky-900 dark:text-sky-100',
            };
            const toastIcons = {
                success: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`,
                error: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" /></svg>`,
                warning: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M4.93 19h14.14a2 2 0 001.94-2.5l-4.24-12A2 2 0 0014.93 3H9.07a2 2 0 00-1.83 1.25l-4.24 12A2 2 0 004.93 19z" /></svg>`,
                info: `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18a9 9 0 110-18 9 9 0 010 18z" /></svg>`,
            };

            return {
                sidebarOpen: true,
                mobileMenuOpen: false,
                darkMode: false,
                hasStoredTheme: false,
                mediaQuery: null,
                toasts: [],
                toastCounter: 0,
                seenToastKeys: new Set(),
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
                        if (this.hasStoredTheme) return;
                        this.darkMode = event.matches;
                        this.applyTheme();
                    };

                    if (typeof this.mediaQuery.addEventListener === 'function') {
                        this.mediaQuery.addEventListener('change', syncSystemPreference);
                    } else if (typeof this.mediaQuery.addListener === 'function') {
                        this.mediaQuery.addListener(syncSystemPreference);
                    }

                    flashToasts.forEach(toast => this.showToast(toast));

                    window.addEventListener('toast', event => {
                        this.showToast(event.detail || {});
                    });

                    if (typeof window.$toast !== 'function') {
                        window.$toast = toast =>
                            window.dispatchEvent(new CustomEvent('toast', {
                                detail: toast
                            }));
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
                },
                showToast(toast) {
                    if (!toast || !toast.message) return;

                    const raw =
                        typeof toast.message === 'string' ? toast.message : String(toast.message ?? '');
                    const message = raw.trim();
                    if (!message) return;

                    const type = toast.type ?? 'info';
                    const key = `${type}|${message}`;
                    if (this.seenToastKeys.has(key)) return;

                    const entry = {
                        id: ++this.toastCounter,
                        message,
                        type,
                    };

                    this.seenToastKeys.add(key);
                    this.toasts.push(entry);

                    const duration = Number(toast.duration ?? 5000);
                    if (!Number.isNaN(duration) && duration > 0) {
                        setTimeout(() => this.dismissToast(entry.id), duration);
                    }
                },
                dismissToast(id) {
                    const entry = this.toasts.find(toast => toast.id === id);
                    if (entry) {
                        this.seenToastKeys.delete(`${entry.type}|${entry.message}`);
                    }

                    this.toasts = this.toasts.filter(toast => toast.id !== id);
                },
                toastStyles(type) {
                    return toastStylesMap[type] ?? toastStylesMap.info;
                },
                toastIcon(type) {
                    return toastIcons[type] ?? toastIcons.info;
                },
            }
        }
    </script>

    <script>
        function notificationDropdown(hasUnread) {
            return {
                open: false,
                hasUnread: hasUnread,
                marking: false,
                toggle() {
                    this.open = !this.open;
                    if (this.open) {
                        this.markRead();
                    }
                },
                async markRead() {
                    if (!this.hasUnread || this.marking) {
                        return;
                    }

                    this.marking = true;

                    try {
                        await fetch('{{ route('dashboard.notifications.mark-read') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        });
                        this.hasUnread = false;
                    } catch (error) {
                        this.marking = false;
                    }
                },
            }
        }
    </script>

</body>

</html>
