<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 border-b border-indigo-700 sticky top-0 z-50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="transform hover:scale-105 transition-transform duration-200">
                    <h1 class="text-2xl font-bold text-white drop-shadow-lg tracking-wide">JobBoard</h1>
                </a>
            </div>

            <!-- Desktop Nav Links -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-yellow-300 font-medium transition-colors duration-200 !border-l-0 !border-transparent">Home</x-nav-link>

                @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-yellow-300 font-medium transition-colors duration-200 !border-l-0 !border-transparent">Dashboard</x-nav-link>
                @endauth
            </div>

            <!-- Desktop Auth Links / Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 font-medium transition-colors duration-200">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-indigo-600 rounded-lg hover:bg-yellow-300 hover:text-indigo-700 font-semibold shadow-md transform hover:scale-105 transition-all duration-200">Register</a>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-white border-opacity-30 text-sm font-medium rounded-lg text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none backdrop-blur-sm transition-all duration-200">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white hover:bg-opacity-20 focus:outline-none transition-all duration-200">
                    <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="sm:hidden" x-show="open" @click.away="open = false">
        <div class="px-2 pt-2 pb-3 space-y-1 flex flex-col bg-indigo-700 bg-opacity-50 backdrop-blur-sm">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block w-full text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-200 !border-l-0 !border-transparent">Home</x-nav-link>

            @auth
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block w-full text-white hover:bg-white hover:bg-opacity-20 rounded-lg transition-all duration-200 !border-l-0 !border-transparent">Dashboard</x-nav-link>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="block w-full px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block w-full px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                    Register
                </a>
            @else
                <x-dropdown-link :href="route('profile.edit')" class="block w-full px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                    Profile
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full px-3 py-2 rounded-lg text-base font-medium text-white hover:bg-white hover:bg-opacity-20 transition-all duration-200">
                        Log Out
                    </x-dropdown-link>
                </form>
            @endguest
        </div>
    </div>
</nav>