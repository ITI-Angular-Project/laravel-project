@php
    $navLinks = [
        ['label' => __('Home'), 'route' => 'home', 'active' => 'home'],
        ['label' => __('Jobs'), 'route' => 'jobs', 'active' => 'jobs'],
        ['label' => __('About'), 'route' => 'about', 'active' => 'about'],
        ['label' => __('Contact'), 'route' => 'contact.form', 'active' => 'contact.*'],
    ];
@endphp

<nav x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-transparent bg-white/95 dark:bg-gray-900/85 backdrop-blur supports-[backdrop-filter]:bg-white/75 dark:supports-[backdrop-filter]:bg-gray-900/70 shadow-[0_15px_45px_rgba(15,23,42,0.12)] transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 gap-4">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group" aria-label="{{ __('HireOn home') }}">
                    <x-application-logo class="h-9 w-auto transition-transform duration-300 group-hover:scale-110" />
                    <span class="text-base sm:text-lg font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                        {{ env('APP_NAME') }}
                    </span>
                </a>

                <div
                    class="hidden md:flex items-center gap-2 rounded-full bg-gray-50/70 dark:bg-white/5 px-2 py-1 shadow-inner shadow-gray-200/40 dark:shadow-none">
                    @foreach ($navLinks as $link)
                        @php($isActive = request()->routeIs($link['active']))
                        <a href="{{ route($link['route']) }}"
                            class="relative px-4 py-2 text-sm font-semibold rounded-full transition duration-200 {{ $isActive ? 'text-amber-700 dark:text-amber-300 bg-white dark:bg-amber-500/10 shadow-sm shadow-amber-100/70 dark:shadow-none' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-white/60 dark:hover:bg-white/10' }}"
                            @if ($isActive) aria-current="page" @endif>
                            {{ $link['label'] }}
                            @if ($isActive)
                                <span class="absolute inset-x-3 -bottom-1 h-0.5 rounded-full bg-amber-400"></span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-4">
                <button type="button" @click="$store.theme.toggle()"
                    class="p-2 rounded-xl border border-gray-200/80 dark:border-gray-700 text-gray-600 dark:text-gray-200 bg-white/80 dark:bg-gray-800/70 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                    :aria-pressed="$store.theme.dark.toString()" aria-label="{{ __('Toggle dark mode') }}">
                    <svg x-show="$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg x-show="!$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors duration-200">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-amber-600 text-white shadow-[0_10px_25px_rgba(251,191,36,0.45)] hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition">
                        {{ __('Register') }}
                    </a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-gray-200/80 dark:border-gray-700 text-sm font-medium rounded-xl text-gray-700 dark:text-gray-200 bg-white/80 dark:bg-gray-900/70 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @canAny(['admin-view', 'demo-view', 'employer-view'])
                                <x-dropdown-link :href="route('dashboard.home')">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                            @endcan
                            <x-dropdown-link :href="route('dashboard.profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>

                @endguest
            </div>

            <div class="-mr-2 flex sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center rounded-xl p-2 text-gray-600 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500 transition hover:bg-gray-100 dark:hover:bg-gray-800"
                    aria-controls="primary-navigation" :aria-expanded="open.toString()">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-cloak x-show="open"
        class="sm:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900"
        id="primary-navigation">
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($navLinks as $link)
                @php($isActive = request()->routeIs($link['active']))
                <a href="{{ route($link['route']) }}"
                    class="block px-4 py-2 text-base font-semibold {{ $isActive ? 'text-amber-600 bg-amber-50 dark:text-amber-200 dark:bg-amber-500/10' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200/70 dark:border-gray-800 px-4 space-y-3">
            <button type="button" @click="$store.theme.toggle()"
                class="flex w-full items-center gap-3 rounded-xl border border-gray-200/70 dark:border-gray-700 px-3 py-2 text-sm text-gray-700 dark:text-gray-200">
                <svg x-show="!$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg x-show="$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                </svg>
                <span>
                    <span x-show="!$store.theme.dark" x-cloak>{{ __('Dark mode') }}</span>
                    <span x-show="$store.theme.dark" x-cloak>{{ __('Light mode') }}</span>
                </span>
            </button>


            @auth
                @canAny(['admin-view', 'employer-view', 'demo-view'])
                    <x-nav-link :href="route('dashboard.home')" :active="request()->routeIs('dashboard')"
                        class="block w-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 !border-l-0 !border-transparent">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @endcan
            @endauth

            <div class="pt-3 border-t border-gray-200/60 dark:border-gray-800"></div>

            @guest
                <a href="{{ route('login') }}"
                    class="block w-full px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full px-3 py-2 rounded-lg text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-500 transition-all duration-200">
                    {{ __('Register') }}
                </a>
            @else
                <x-dropdown-link :href="route('dashboard.profile.edit')"
                    class="block w-full px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            @endguest

        </div>
    </div>
</nav>
