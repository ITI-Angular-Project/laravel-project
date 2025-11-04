<!DOCTYPE html>
<html lang="en" x-data="dashboard()" x-init="initTheme()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireOn Dashboard</title>

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-500">

<div class="flex">
    {{-- ✅ Sidebar (PC Only) --}}
    <aside class="hidden md:block bg-white dark:bg-gray-800 h-screen p-4 border-r dark:border-gray-700
        transition-[width] duration-300 ease-in-out"
        :class="sidebarOpen ? 'w-64' : 'w-20'">

        <div class="flex justify-between items-center mb-8">
            <span x-show="sidebarOpen" class="text-xl font-bold transition-opacity duration-300">HireOn</span>

            {{-- Toggle Sidebar --}}
            <button class="p-2 bg-gray-200 dark:bg-gray-700 rounded transition duration-300"
                @click="toggleSidebar()">
                <span x-show="sidebarOpen">◀</span>
                <span x-show="!sidebarOpen">▶</span>
            </button>
        </div>

        <ul class="space-y-4">
            <li><a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-blue-500 transition">🏠 <span x-show="sidebarOpen" class="transition-opacity duration-300">Dashboard</span></a></li>
            <li><a href="{{ route('jobs') }}" class="flex items-center gap-2 hover:text-blue-500 transition">💼 <span x-show="sidebarOpen" class="transition-opacity duration-300">Jobs</span></a></li>
            <li><a href="{{ route('applications') }}" class="flex items-center gap-2 hover:text-blue-500 transition">📥 <span x-show="sidebarOpen" class="transition-opacity duration-300">Applications</span></a></li>
            <li><a href="{{ route('profile') }}" class="flex items-center gap-2 hover:text-blue-500 transition">👤 <span x-show="sidebarOpen" class="transition-opacity duration-300">Profile</span></a></li>
        </ul>
    </aside>

    <main class="flex-1">

        {{-- ✅ Navbar --}}
        <header class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 border-b dark:border-gray-700
            transition duration-500 transform opacity-0 -translate-y-2"
            x-init="setTimeout(() => {$el.classList.remove('opacity-0', '-translate-y-2')}, 50)">

            <button class="md:hidden p-2 bg-gray-200 dark:bg-gray-700 rounded"
                @click="mobileMenuOpen = !mobileMenuOpen">
                ☰
            </button>

            <h1 class="font-bold">Dashboard</h1>

            <div class="flex items-center gap-4">
                <span>{{ auth()->user()->name ?? 'Ahmed' }}</span>

                {{-- ✅ Theme Toggle --}}
                <button class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded transition duration-300"
                    @click="toggleTheme()">
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode">☀️</span>
                </button>
            </div>
        </header>

        {{-- ✅ Mobile Dropdown Menu --}}
        <nav class="md:hidden bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-4 origin-top"
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            @click.outside="mobileMenuOpen = false">

            <ul class="space-y-4">
                <li><a href="{{ route('dashboard') }}" class="block">🏠 Dashboard</a></li>
                <li><a href="{{ route('jobs') }}" class="block">💼 Jobs</a></li>
                <li><a href="{{ route('applications') }}" class="block">📥 Applications</a></li>
                <li><a href="{{ route('profile') }}" class="block">👤 Profile</a></li>
            </ul>
        </nav>

        {{-- Page Content Placeholder --}}
        <section class="p-6 opacity-0" x-data
            x-init="setTimeout(() => $el.classList.remove('opacity-0'), 150)"
            x-transition:enter="transition-opacity duration-500"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">
            @yield('content')
        </section>

    </main>
</div>

<script>
function dashboard() {
    return {
        sidebarOpen: true,
        mobileMenuOpen: false,
        darkMode: false,

        initTheme() {
            this.darkMode = localStorage.getItem('darkMode') === 'true';
            document.documentElement.classList.toggle('dark', this.darkMode);
        },

        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            document.documentElement.classList.toggle('dark', this.darkMode);
        },

        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
        }
    }
}
</script>

</body>
</html>
