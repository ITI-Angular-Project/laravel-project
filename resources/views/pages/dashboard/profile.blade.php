@extends('layouts.dashboard.app')

@section('content')
<div class="container mx-auto py-6 px-4 md:px-0 max-w-6xl">

    {{-- Profile Card --}}
    <div class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/40 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300">

        {{-- Header with gradient background --}}
        <div class="relative bg-amber-600/10 dark:bg-amber-600/10 p-5 overflow-hidden ring-1 ring-inset ring-amber-600/20">
            {{-- Decorative blurred corner accents with custom color --}}
            <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl" style="background-color: oklch(75% 0.183 55.934 / 0.5);"></div>
            <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl" style="background-color: oklch(75% 0.183 55.934 / 0.35);"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 rounded-full blur-xl" style="background-color: oklch(75% 0.183 55.934 / 0.25);"></div>

            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold text-amber-700 dark:text-amber-300 tracking-tight drop-shadow-sm">
                    Profile
                </h1>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="p-5">
            {{--show success message--}}
            @if (session('status'))
                <div class="mb-5 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 p-4 rounded-xl">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('dashboard.profile.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Form Fields Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Name --}}
                    <div class="group bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200">
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="w-full border-0 bg-transparent text-gray-900 dark:text-gray-100 font-semibold focus:ring-2 focus:ring-amber-400 rounded-lg p-2">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="group bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200">
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="w-full border-0 bg-transparent text-gray-900 dark:text-gray-100 font-semibold focus:ring-2 focus:ring-amber-400 rounded-lg p-2">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="group bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200">
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                            class="w-full border-0 bg-transparent text-gray-900 dark:text-gray-100 font-semibold focus:ring-2 focus:ring-amber-400 rounded-lg p-2">
                        @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- New Password --}}
                    <div class="group bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200">
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">New Password</label>
                        <input type="password" name="password"
                            class="w-full border-0 bg-transparent text-gray-900 dark:text-gray-100 font-semibold focus:ring-2 focus:ring-amber-400 rounded-lg p-2">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="group bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-amber-400 dark:hover:border-amber-500 hover:shadow-md transition-all duration-200 md:col-span-2">
                        <label class="block text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border-0 bg-transparent text-gray-900 dark:text-gray-100 font-semibold focus:ring-2 focus:ring-amber-400 rounded-lg p-2">
                    </div>
                </div>

                {{-- Update Button --}}
                <div class="flex flex-wrap gap-2 pt-3 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Account Card --}}
<div class="mt-6 bg-gradient-to-br from-red-50 via-red-50/30 to-red-50/40 dark:from-red-900/20 dark:via-red-900/10 dark:to-red-900/20 rounded-2xl shadow-xl border border-red-200/60 dark:border-red-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300">

    {{-- Header --}}
    <div class="relative bg-red-600/10 dark:bg-red-600/10 p-5 overflow-hidden ring-1 ring-inset ring-red-600/20">
        <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl bg-red-500/20"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl bg-red-500/15"></div>

        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-red-700 dark:text-red-300 tracking-tight drop-shadow-sm">
                Delete Account
            </h2>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5">
        <p class="text-gray-700 dark:text-gray-300 mb-4">
            Once you delete your account, all of its resources and data will be permanently deleted.
            This action cannot be undone.
        </p>
        <button type="button" onclick="document.getElementById('confirmDeleteModal').classList.remove('hidden')"
            class="inline-flex items-center justify-center rounded-2xl bg-red-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Account
        </button>
    </div>
</div>

{{-- Modal for Password Confirmation --}}
<div id="confirmDeleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
            Confirm Account Deletion
        </h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">
            Please enter your password to confirm you want to permanently delete your account.
        </p>

        <form method="POST" action="{{ route('dashboard.profile.destroy') }}">
            @csrf
            @method('DELETE')

            <input type="password" name="password" placeholder="Enter your password"
                   class="w-full mb-4 border rounded-lg p-2 dark:bg-slate-700 dark:border-slate-600 dark:text-gray-100" required>

            <div class="flex justify-end gap-3">
                <button type="button"
                        onclick="document.getElementById('confirmDeleteModal').classList.add('hidden')"
                        class="bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 rounded-lg">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>


</div>
@endsection
