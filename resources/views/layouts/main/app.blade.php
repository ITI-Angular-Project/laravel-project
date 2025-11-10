<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- seo --}}
    <meta name="description" content="@yield('meta_description', 'Welcome to ' . config('app.name'))">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title')) ?: config('app.name'))">
    <meta property="og:description" content="@yield('og_description', trim($__env->yieldContent('meta_description')) ?: ('Welcome to ' . config('app.name')))">
    <meta property="og:image" content="@yield('og_image', asset('images/app-logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:image:width" content="@yield('og_image_width', '1200')">
    <meta property="og:image:height" content="@yield('og_image_height', '630')">
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
    <meta name="twitter:title" content="@yield('twitter_title', trim($__env->yieldContent('og_title')) ?: (trim($__env->yieldContent('title')) ?: config('app.name')))">
    <meta name="twitter:description" content="@yield('twitter_description', trim($__env->yieldContent('og_description')) ?: (trim($__env->yieldContent('meta_description')) ?: ('Welcome to ' . config('app.name'))))">
    <meta name="twitter:image" content="@yield('twitter_image', trim($__env->yieldContent('og_image')) ?: asset('images/social/default-og.jpg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function showToast(type, message) {
            if (window.toastManager) {
                window.toastManager.addToast(type, message);
            } else {
                // Fallback: dispatch custom event
                window.dispatchEvent(new CustomEvent('toast', {
                    detail: {
                        type,
                        message
                    }
                }));
            }
        }

        function toastManager() {
            return {
                toasts: [],
                addToast(type, message) {
                    const id = Date.now() + Math.random();
                    this.toasts.push({ id, type, message });
                    setTimeout(() => this.dismissToast(id), 5000); // Auto dismiss after 5 seconds
                },
                dismissToast(id) {
                    this.toasts = this.toasts.filter(toast => toast.id !== id);
                },
                toastStyles(type) {
                    const styles = {
                        success: 'border-green-200 dark:border-green-800',
                        error: 'border-red-200 dark:border-red-800',
                        warning: 'border-yellow-200 dark:border-yellow-800',
                        info: 'border-blue-200 dark:border-blue-800'
                    };
                    return styles[type] || styles.info;
                },
                toastIcon(type) {
                    const icons = {
                        success: '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                        error: '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                        warning: '<svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
                        info: '<svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
                    };
                    return icons[type] || icons.info;
                }
            };
        }

        // Listen for toast events
        window.addEventListener('toast', (event) => {
            const { type, message } = event.detail;
            if (window.toastManager) {
                window.toastManager.addToast(type, message);
            }
        });

        // Make toastManager available globally
        window.toastManager = toastManager();
    </script>
</head>

<body class="font-sans antialiased bg-white text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
        <!-- Global Navigation -->
        @include('layouts.main.navigation')

        <!-- Page Heading (optional) -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>

        <!-- Global Footer -->
        @include('layouts.main.footer')

        <!-- Toast Stack Component -->
        <x-ui.toast-stack />
    </div>
</body>

</html>
