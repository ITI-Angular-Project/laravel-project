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
    </div>
</body>

</html>
