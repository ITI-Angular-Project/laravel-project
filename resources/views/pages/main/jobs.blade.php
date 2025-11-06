<x-app-layout>
    <!-- Jobs Page -->
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3">
                    Browse All Jobs
                </h1>
                <div class="w-20 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Explore thousands of job opportunities with top companies
                </p>
            </div>

            <!-- Filters Section -->
            <div class="mb-8">
                <form action="{{ route('jobs') }}" method="GET" class="space-y-3">
                    <!-- Main Search Bar -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-3 shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col md:flex-row gap-2">
                            <!-- Keywords Search -->
                            <div class="flex-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="keyword" placeholder="Job title or keyword"
                                    value="{{ request('keyword') }}"
                                    class="w-full pl-10 pr-4 py-2.5 border-0 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all">
                            </div>

                            <!-- Location Search -->
                            <div class="flex-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <input type="text" name="location" placeholder="Location"
                                    value="{{ request('location') }}"
                                    class="w-full pl-10 pr-10 py-2.5 border-0 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 transition-all">
                                @if(request('location'))
                                <button type="button" onclick="this.previousElementSibling.value=''; this.closest('form').submit();" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                @endif
                            </div>

                            <!-- Search Button -->
                            <div>
                                <button type="submit"
                                    class="w-full md:w-auto whitespace-nowrap bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-200 px-8 py-2.5 shadow-sm hover:shadow-md">
                                    Search jobs
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Filters -->
                    <div class="flex flex-col md:flex-row gap-2">
                        <!-- Date Posted -->
                        <div class="flex-1 relative">
                            <select name="date_posted" class="w-full appearance-none px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all cursor-pointer">
                                <option value="">Date Posted</option>
                                <option value="24h" {{ request('date_posted') == '24h' ? 'selected' : '' }}>Last 24 hours</option>
                                <option value="7d" {{ request('date_posted') == '7d' ? 'selected' : '' }}>Last 7 days</option>
                                <option value="30d" {{ request('date_posted') == '30d' ? 'selected' : '' }}>Last 30 days</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="flex-1 relative">
                            <select name="category_id" class="w-full appearance-none px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all cursor-pointer">
                                <option value="">Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Experience -->
                        <div class="flex-1 relative">
                            <select name="experience_level" class="w-full appearance-none px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all cursor-pointer">
                                <option value="">Experience</option>
                                <option value="entry" {{ request('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                                <option value="mid" {{ request('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                                <option value="senior" {{ request('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Salary Range -->
                        <div class="flex-1 relative">
                            <select name="salary_range" class="w-full appearance-none px-4 py-2.5 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-transparent transition-all cursor-pointer">
                                <option value="">Salary range</option>
                                @foreach($salaryRanges as $range)
                                   <option value="{{ $range }}" {{ request('salary_range') == $range ? 'selected' : '' }}>
                                    {{ $range }}
                                   </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="mb-6">
                <p class="text-gray-600 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $jobs->count() }}</span> jobs
                </p>
            </div>

            <!-- Jobs Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($jobs as $job)
                <a href="#"
                   class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

                    <!-- Job Details Only -->
                    <div class="p-5 space-y-3">
                        <!-- Job Title -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-1">
                            {{ $job->title }}
                        </h3>

                        <!-- Work Type -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                            @if($job->work_type == 'remote') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            @elseif($job->work_type == 'on_site') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400
                            @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $job->work_type)) }}
                        </span>

                        <!-- Posted Date -->
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Posted: {{ $job->created_at->format('Y-m-d') }}</span>
                        </div>

                        <!-- Deadline -->
                        @if($job->deadline)
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Deadline: {{ $job->deadline }}</span>
                        </div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            
        </div>
    </div>
</x-app-layout>