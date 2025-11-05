@extends('layouts.dashboard.app')

@section('pageTitle', 'Users Management')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">

                <!-- Header Section -->
                <div
                    class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10 dark:from-indigo-500/5 dark:via-purple-500/5 dark:to-pink-500/5 group-hover:from-indigo-500/15 group-hover:via-purple-500/15 group-hover:to-pink-500/15 transition-all duration-300">
                    </div>
                    <div class="relative px-6 sm:px-8 py-6">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div class="space-y-2">
                                <h1
                                    class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 dark:from-white dark:via-gray-200 dark:to-white bg-clip-text text-transparent animate-in fade-in slide-in-from-left duration-500">
                                    Users Management
                                </h1>
                                <p
                                    class="text-gray-600 dark:text-gray-400 text-sm sm:text-base animate-in fade-in slide-in-from-left duration-500 delay-75">
                                    Manage user accounts, roles, and permissions with ease
                                </p>
                                <div
                                    class="text-sm text-gray-500 dark:text-gray-400 animate-in fade-in slide-in-from-left duration-500 delay-100">
                                    {{ $users->total() }} total users
                                    @if (request('search') || request('role'))
                                        <span class="mx-2">•</span> filtered results
                                    @endif
                                </div>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row gap-3 animate-in fade-in slide-in-from-right duration-500 delay-100">
                                <a href="{{ route('dashboard.users.create') }}"
                                    class="group inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold py-3.5 px-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.03] active:scale-[0.98] motion-safe:transition relative overflow-hidden"
                                    aria-label="Create new user">
                                    <span
                                        class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                                    <span
                                        class="inline-flex h-6 w-6 items-center justify-center rounded-xl bg-white/15 group-hover:bg-white/25 transition-all duration-300 group-hover:rotate-90"
                                        aria-hidden="true">+</span>
                                    <span class="relative z-10">Create New User</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div
                    class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-indigo-500/5 to-purple-500/5 dark:from-blue-500/3 dark:via-indigo-500/3 dark:to-purple-500/3">
                    </div>
                    <div class="relative p-6 sm:p-8 animate-in fade-in slide-in-from-bottom duration-500 delay-150">

                        <form method="GET" action="{{ route('dashboard.users.index') }}" class="space-y-6"
                            x-data="{ q: @entangle('search').defer }">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Search Input -->
                                <div class="lg:col-span-2">
                                    <label for="search"
                                        class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                        Search Users
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                                            placeholder="Type name or email to search..."
                                            class="block w-full pl-11 pr-4 py-3.5 border border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-400/30 transition-all duration-300 text-base hover:border-gray-400 dark:hover:border-gray-500 focus:shadow-lg focus:shadow-indigo-500/20" />
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Role Filter -->
                                <div>
                                    <label for="role"
                                        class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                        Filter by Role
                                    </label>
                                    <select id="role" name="role"
                                        class="block w-full px-4 py-3.5 border border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-300 text-base hover:border-gray-400 dark:hover:border-gray-500 focus:shadow-lg focus:shadow-indigo-500/20 cursor-pointer">
                                        <option value="all"
                                            {{ request('role') === 'all' || !request('role') ? 'selected' : '' }}>All Roles
                                        </option>
                                        <option value="{{ \App\Models\User::ROLE_ADMIN }}"
                                            {{ request('role') === \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="{{ \App\Models\User::ROLE_EMPLOYER }}"
                                            {{ request('role') === \App\Models\User::ROLE_EMPLOYER ? 'selected' : '' }}>
                                            Employer</option>
                                        <option value="{{ \App\Models\User::ROLE_CANDIDATE }}"
                                            {{ request('role') === \App\Models\User::ROLE_CANDIDATE ? 'selected' : '' }}>
                                            Candidate</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] text-base motion-safe:transition relative overflow-hidden group">
                                    <span
                                        class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                                    <span class="relative z-10">Apply Filters</span>
                                </button>

                                @if (request('search') || request('role'))
                                    <a href="{{ route('dashboard.users.index') }}"
                                        class="inline-flex items-center justify-center gap-3 px-6 py-3.5 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gradient-to-r hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-700 dark:hover:to-gray-600 rounded-2xl transition-all duration-300 font-medium text-base motion-safe:transition transform hover:-translate-y-0.5 hover:scale-[1.01] active:scale-[0.98]">
                                        Clear Filters
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div
                        class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-xl shadow-lg animate-in slide-in-from-top duration-300">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl shadow-lg animate-in slide-in-from-top duration-300">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                <!-- Users Table Card -->
                <div
                    class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-3xl animate-in fade-in slide-in-from-bottom duration-500 delay-200">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-slate-50/50 via-white/50 to-gray-50/50 dark:from-gray-800/50 dark:via-gray-800/50 dark:to-gray-800/50">
                    </div>
                    <div class="relative">
                        <div
                            class="px-6 sm:px-8 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2
                                        class="text-lg sm:text-xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                                        Users Directory</h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Overview of all system users</p>
                                </div>
                                <div class="text-right">
                                    <div
                                        class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        {{ $users->total() }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Total</div>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead
                                    class="bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-800 dark:to-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                            Full Name
                                        </th>
                                        <th
                                            class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                            Email Address
                                        </th>
                                        <th
                                            class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                            User Role
                                        </th>
                                        <th
                                            class="px-6 sm:px-8 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($users as $user)
                                        <tr class="group hover:bg-gradient-to-r hover:from-indigo-50/60 hover:to-purple-50/60 dark:hover:from-indigo-900/10 dark:hover:to-purple-900/10 transition-all duration-300 hover:shadow-lg hover:scale-[1.01] animate-in fade-in slide-in-from-left duration-500"
                                            style="animation-delay: {{ $loop->index * 50 }}ms">
                                            <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                                <div class="flex items-center gap-4">
                                                    <div class="h-11 w-11 rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white font-bold select-none shadow-lg shadow-indigo-500/30 transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl group-hover:shadow-purple-500/40 group-hover:rotate-3"
                                                        aria-hidden="true">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div
                                                            class="text-sm font-semibold text-gray-900 dark:text-white transition-colors duration-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                                            {{ $user->name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                                            ID: {{ $user->id }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100 font-medium">
                                                    {{ $user->email }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    Verified
                                                </div>
                                            </td>

                                            <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-gray-100 dark:bg-gray-800 shadow-sm transition-all duration-300 group-hover:scale-110 group-hover:shadow-md
                                                    @if ($user->role === \App\Models\User::ROLE_ADMIN) text-red-600 dark:text-red-400
                                                    @elseif($user->role === \App\Models\User::ROLE_EMPLOYER) text-blue-600 dark:text-blue-400
                                                    @else text-green-600 dark:text-green-400 @endif">
                                                    {{ ucfirst($user->role) }}

                                            <td class="px-6 sm:px-8 py-5 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('dashboard.users.edit', $user) }}"
                                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-indigo-600 dark:text-indigo-400 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transform hover:scale-110 hover:shadow-lg active:scale-95 group"
                                                        aria-label="Edit {{ $user->name }}">
                                                        <svg class="w-5 h-5 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors duration-200"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>

                                                    @if ($user->id !== auth()->id())
                                                        <form method="POST"
                                                            action="{{ route('dashboard.users.destroy', $user) }}"
                                                            class="inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-red-600 dark:text-red-400 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500/50 transform hover:scale-110 hover:shadow-lg active:scale-95 group"
                                                                aria-label="Delete {{ $user->name }}">
                                                                <svg class="w-5 h-5 group-hover:text-red-700 dark:group-hover:text-red-300 transition-colors duration-200"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 sm:px-8 py-16 text-center">
                                                <div class="space-y-3 animate-in fade-in zoom-in duration-500">
                                                    <div
                                                        class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 mb-4 mx-auto">
                                                        <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <h3
                                                        class="text-lg sm:text-xl font-bold bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                                                        No Users Found</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                                                        No users match your search. Adjust your filters or create a new user
                                                        to get started.
                                                    </p>
                                                    <a href="{{ route('dashboard.users.create') }}"
                                                        class="inline-flex items-center gap-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-700 hover:via-purple-700 hover:to-indigo-800 text-white font-semibold py-3 px-6 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:scale-[1.03] active:scale-[0.98] relative overflow-hidden group mt-4">
                                                        <span
                                                            class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></span>
                                                        <span
                                                            class="inline-flex h-6 w-6 items-center justify-center rounded-xl bg-white/15 group-hover:bg-white/25 transition-all duration-300 group-hover:rotate-90 relative z-10"
                                                            aria-hidden="true">+</span>
                                                        <span class="relative z-10">Create First User</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($users->hasPages())
                            <div
                                class="px-6 sm:px-8 py-6 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800">
                                <div class="flex items-center justify-end">
                                    {{ $users->appends(request()->query())->links() }}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
