<x-app-layout>
    <!-- Hero Section -->
    <div
        class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-indigo-950 dark:to-purple-950 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-300/50 to-purple-300/50 dark:from-indigo-500/25 dark:to-purple-500/25 rounded-full blur-3xl animate-blob">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-purple-300/50 to-pink-300/50 dark:from-purple-500/25 dark:to-pink-500/25 rounded-full blur-3xl animate-blob-reverse animation-delay-2000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 w-64 h-64 bg-gradient-to-r from-blue-300/40 to-indigo-300/40 dark:from-blue-500/20 dark:to-indigo-500/20 rounded-full blur-2xl animate-blob-spin animation-delay-4000">
            </div>
        </div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="text-center space-y-8">
                <!-- Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 bg-indigo-100 dark:bg-indigo-900/50 backdrop-blur-sm rounded-full text-indigo-700 dark:text-indigo-300 text-sm font-medium animate-fade-in-down border border-indigo-200 dark:border-indigo-800">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    #1 Job Board Platform
                </div>

                <!-- Main Heading -->
                <h1
                    class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight animate-fade-in-up">
                    Find Your Dream Job
                    <span
                        class="block mt-2 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
                        Today
                    </span>
                </h1>

                <!-- Subheading -->
                <p class="max-w-2xl mx-auto text-lg sm:text-xl text-gray-700 dark:text-gray-300 animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    Discover thousands of opportunities from top companies. Your next career move starts here.
                </p>

                <!-- Search Box -->
                <div class="max-w-4xl mx-auto mt-10 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <form action="{{ route('dashboard.home') }}" method="GET"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 space-y-4 border border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Keywords Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="keywords" placeholder="Job title or keywords"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:bg-white dark:focus:bg-gray-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200">
                            </div>

                            <!-- Location Input -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="location" placeholder="City or state"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:bg-white dark:focus:bg-gray-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all duration-200">
                            </div>

                            <!-- Category Select -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </div>
                                <select name="category"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:bg-white dark:focus:bg-gray-600 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 appearance-none transition-all duration-200">
                                    <option value="">All Categories</option>
                                    <option value="technology">Technology</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="design">Design</option>
                                    <option value="finance">Finance</option>
                                    <option value="healthcare">Healthcare</option>
                                </select>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <button type="submit"
                            class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search Jobs
                            </span>
                        </button>
                    </form>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-3xl mx-auto pt-8 animate-fade-in-up"
                    style="animation-delay: 0.6s;">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">10K+</div>
                        <div class="text-gray-600 dark:text-gray-400 mt-1">Active Jobs</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">5K+</div>
                        <div class="text-gray-600 dark:text-gray-400 mt-1">Companies</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">50K+</div>
                        <div class="text-gray-600 dark:text-gray-400 mt-1">Happy Users</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Shape Divider -->
        <div class="absolute bottom-0 left-0 right-0 overflow-hidden">
            <svg class="w-full h-16 sm:h-24 fill-current text-white dark:text-gray-900 animate-wave"
                viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path
                    d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                </path>
            </svg>
            <svg class="w-full h-16 sm:h-24 fill-current text-white/50 dark:text-gray-900/50 absolute bottom-0 animate-wave-slow"
                viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path
                    d="M0,80L80,74.7C160,69,320,59,480,64C640,69,800,91,960,96C1120,101,1280,91,1360,85.3L1440,80L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Additional Sections -->
    <div class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">How It Works</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Start your journey to finding the perfect
                    job in three simple steps</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="text-center p-6 rounded-xl bg-white dark:bg-gray-800 hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Search Jobs</h3>
                    <p class="text-gray-600 dark:text-gray-400">Browse through thousands of job listings from top
                        companies</p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-white dark:bg-gray-800 hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Apply</h3>
                    <p class="text-gray-600 dark:text-gray-400">Submit your application with just a few clicks</p>
                </div>

                <div
                    class="text-center p-6 rounded-xl bg-white dark:bg-gray-800 hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <div
                        class="w-16 h-16 bg-pink-100 dark:bg-pink-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Get Hired</h3>
                    <p class="text-gray-600 dark:text-gray-400">Connect with employers and land your dream job</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs Category Section -->
    <div class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-3">
                    Browse Jobs By Category
                </h2>
                <div
                    class="w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 mx-auto rounded-full">
                </div>
                <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Explore opportunities across various industries and find the perfect match for your skills
                </p>
            </div>

            <!-- Category Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Technology Category -->
                <a href="{{ route('dashboard.home', ['category' => 'technology']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <!-- Icon Container -->
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-indigo-50 dark:from-indigo-900/30 dark:to-indigo-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <!-- Category Name -->
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Technology</h3>
                        <!-- Job Count -->
                        <p class="text-sm text-gray-500 dark:text-gray-400">2,500+ Jobs</p>
                        <!-- Arrow Icon -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Insurance Category -->
                <a href="{{ route('dashboard.home', ['category' => 'insurance']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-50 dark:from-purple-900/30 dark:to-purple-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Insurance</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">1,200+ Jobs</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Banking Category -->
                <a href="{{ route('dashboard.home', ['category' => 'banking']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900/30 dark:to-blue-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Banking</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">1,800+ Jobs</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Automotive Category -->
                <a href="{{ route('dashboard.home', ['category' => 'automotive']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-red-500 dark:hover:border-red-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-50 dark:from-red-900/30 dark:to-red-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-red-600 dark:text-red-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Automotive</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">950+ Jobs</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Marketing Category -->
                <a href="{{ route('dashboard.home', ['category' => 'marketing']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-green-100 to-green-50 dark:from-green-900/30 dark:to-green-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Marketing</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">1,600+ Jobs</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Government Category -->
                <a href="{{ route('dashboard.home', ['category' => 'government']) }}"
                    class="group relative bg-white dark:bg-gray-900 rounded-2xl p-8 border-2 border-gray-200 dark:border-gray-700 hover:border-amber-500 dark:hover:border-amber-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="flex flex-col items-center text-center space-y-4">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-amber-100 to-amber-50 dark:from-amber-900/30 dark:to-amber-800/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-amber-600 dark:text-amber-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Government</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">750+ Jobs</p>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    View All Categories
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>


    <!-- Featured Jobs Section -->
    <div class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-3">
                    Featured Jobs
                </h2>
                <div
                    class="w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 mx-auto rounded-full">
                </div>
                <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Discover hand-picked opportunities from top companies hiring now
                </p>
            </div>

            <!-- Jobs Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Job Card 1 - Web Developer -->
                <a href="{{ route('dashboard.home', 1) }}"
                    class="group bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=300&fit=crop"
                            alt="Web Developer"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Web Developer
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                FULL TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            London
                        </p>
                    </div>
                </a>

                <!-- Job Card 2 - Graphic Design -->
                <a href="{{ route('dashboard.home', 2) }}"
                    class="group bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-purple-500 to-pink-600">
                        <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&h=300&fit=crop"
                            alt="Graphic Design"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Graphic Design
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                PART TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            London
                        </p>
                    </div>
                </a>

                <!-- Job Card 3 - UI/UX Design -->
                <a href="{{ route('dashboard.home', 3) }}"
                    class="group bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-500 to-cyan-600">
                        <img src="https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=400&h=300&fit=crop"
                            alt="UI/UX Design"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            UI/UX Design
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                FULL TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            London
                        </p>
                    </div>
                </a>

                <!-- Job Card 4 - Mobile Apps -->
                <a href="{{ route('dashboard.home', 4) }}"
                    class="group bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-green-500 to-emerald-600">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=300&fit=crop"
                            alt="Mobile Apps"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                            Mobile Apps
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                FULL TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            London
                        </p>
                    </div>
                </a>
            </div>

            <!-- View All Jobs Button -->
            <div class="text-center mt-12">
                <a href="{{ route('dashboard.home') }}"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    View All Jobs
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>


    <!-- Latest Jobs Section -->
    <div class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-3">
                    Latest Jobs
                </h2>
                <div
                    class="w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 mx-auto rounded-full">
                </div>
                <p class="mt-4 text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Discover the newest opportunities from top companies hiring now
                </p>
            </div>

            <!-- Jobs Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Job Card 1 - Web Developer Senior -->
                <a href="#"
                    class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=300&fit=crop"
                            alt="Web Developer Senior"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            Web Developer Senior
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                FULL TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            London
                        </p>
                    </div>
                </a>

                <!-- Job Card 2 - Internet Marketing -->
                <a href="#"
                    class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-purple-500 to-pink-600">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=300&fit=crop"
                            alt="Internet Marketing"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Internet Marketing
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                PART TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Paris
                        </p>
                    </div>
                </a>

                <!-- Job Card 3 - Website Administrator -->
                <a href="#"
                    class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-500 to-cyan-600">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=400&h=300&fit=crop"
                            alt="Website Administrator"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Website Administrator
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                FULL TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            New York
                        </p>
                    </div>
                </a>

                <!-- Job Card 4 - Web Design and Web Developer -->
                <a href="#"
                    class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-green-500 dark:hover:border-green-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
                    <!-- Job Image -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-green-500 to-emerald-600">
                        <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?w=400&h=300&fit=crop"
                            alt="Web Design and Web Developer"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>

                    <!-- Job Info -->
                    <div class="p-5 space-y-3">
                        <h3
                            class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">
                            Web Design and Web Developer
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            2017-06-07
                        </p>

                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                PART TIME
                            </span>
                        </div>

                        <p class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            San Francisco
                        </p>
                    </div>
                </a>
            </div>

            <!-- View All Jobs Button -->
            <div class="text-center mt-12">
                <a href="{{ route('dashboard.home') }}"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                    View All Jobs
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>


    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateX(0) translateY(0);
            }

            50% {
                transform: translateX(-25px) translateY(-5px);
            }
        }

        @keyframes wave-slow {

            0%,
            100% {
                transform: translateX(0) translateY(0);
            }

            50% {
                transform: translateX(25px) translateY(-8px);
            }
        }

        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(80px, -100px) scale(1.2);
            }

            66% {
                transform: translate(-60px, 60px) scale(0.8);
            }
        }

        @keyframes blob-reverse {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(-100px, 80px) scale(1.3);
            }

            66% {
                transform: translate(70px, -70px) scale(0.85);
            }
        }

        @keyframes blob-spin {

            0%,
            100% {
                transform: translate(0, 0) scale(1) rotate(0deg);
            }

            50% {
                transform: translate(50px, 50px) scale(1.15) rotate(180deg);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .animate-wave {
            animation: wave 8s ease-in-out infinite;
        }

        .animate-wave-slow {
            animation: wave-slow 12s ease-in-out infinite;
        }

        .animate-blob {
            animation: blob 10s ease-in-out infinite;
        }

        .animate-blob-reverse {
            animation: blob-reverse 12s ease-in-out infinite;
        }

        .animate-blob-spin {
            animation: blob-spin 15s ease-in-out infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-app-layout>
