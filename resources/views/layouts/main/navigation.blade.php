<nav x-data="{ open: false }"
    class="sticky top-0 z-50 border-b border-gray-200/60 dark:border-gray-800 bg-white/90 dark:bg-gray-900/70 backdrop-blur supports-[backdrop-filter]:bg-white/70 dark:supports-[backdrop-filter]:bg-gray-900/60 shadow-sm transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo + Primary links -->
            <div class="flex items-center gap-8">
                <!-- Logo / Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <x-application-logo class="hidden sm:block h-9 w-auto fill-current text-indigo-600 dark:text-indigo-400 transition-colors" />
                    <span class="text-base sm:text-lg font-semibold tracking-tight text-gray-900 dark:text-gray-100">
                        {{ env('APP_NAME') }}
                    </span>
                </a>

                <!-- Desktop: Primary navigation -->
                <div class="hidden sm:flex items-center gap-6">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                        class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors duration-200 !border-l-0 !border-b !border-transparent">
                        {{ __('Home') }}
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('dashboard.home')" :active="request()->routeIs('dashboard')"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors duration-200 !border-l-0 !border-b !border-transparent">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Right: Auth / User Dropdown (desktop) -->
            <div class="hidden sm:flex items-center gap-4">
                <button type="button" @click="$store.theme.toggle()"
                    class="p-2 rounded-lg border border-gray-200/80 dark:border-gray-700 text-gray-600 dark:text-gray-200 bg-white/70 dark:bg-gray-800/70 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                    :aria-pressed="$store.theme.dark.toString()" aria-label="{{ __('Toggle dark mode') }}">
                    <svg x-show="!$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <svg x-show="$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition-colors duration-200">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-indigo-600 text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                        {{ __('Register') }}
                    </a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-gray-200/80 dark:border-gray-700 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-200 bg-white/70 dark:bg-gray-800/70 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900 backdrop-blur-sm transition-all duration-200">
                                <div class="mr-2 truncate max-w-[10rem]">{{ Auth::user()->name }}</div>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 dark:text-gray-200">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-gray-700 dark:text-gray-200"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none transition-all duration-200"
                    aria-controls="mobile-menu" :aria-expanded="open.toString()">
                    <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition.opacity x-cloak id="mobile-menu" class="sm:hidden" @click.away="open = false">
        <div
            class="px-4 pt-2 pb-4 space-y-1 bg-white/95 dark:bg-gray-900/95 border-b border-gray-200/60 dark:border-gray-800 backdrop-blur-sm shadow-md">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block w-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 !border-l-0 !border-transparent">
                {{ __('Home') }}
            </x-nav-link>

            <button type="button" @click="$store.theme.toggle()"
                class="flex items-center w-full px-3 py-2 rounded-lg text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200"
                :aria-pressed="$store.theme.dark.toString()">
                <svg x-show="!$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M7.05 16.95l-1.414 1.414m0-12.728 1.414 1.414m9.9 9.9 1.414 1.414M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg x-show="$store.theme.dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                </svg>
                <span class="ml-3">
                    <span x-show="!$store.theme.dark" x-cloak>{{ __('Dark mode') }}</span>
                    <span x-show="$store.theme.dark" x-cloak>{{ __('Light mode') }}</span>
                </span>
            </button>

            @auth
                <x-nav-link :href="route('dashboard.home')" :active="request()->routeIs('dashboard')"
                    class="block w-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 !border-l-0 !border-transparent">
                    {{ __('Dashboard') }}
                </x-nav-link>
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
                <x-dropdown-link :href="route('profile.edit')"
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
