@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-widest text-amber-500 font-semibold">Organization</p>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Company Profile</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Keep your company details up to date so candidates know who
                    they are applying to.</p>
            </div>
            @if ($company?->updated_at)
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Last updated {{ $company->updated_at->diffForHumans() }}
                </p>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-3xl shadow-sm p-6">
            <form method="POST" action="{{ route('dashboard.company.update') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1" for="name">Company
                            Name</label>
                        <input id="name" name="name" type="text" required
                            value="{{ old('name', $company->name ?? '') }}"
                            class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500" />
                        @error('name')
                            <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1"
                            for="website">Website</label>
                        <input id="website" name="website" type="url" placeholder="https://example.com"
                            value="{{ old('website', $company->website ?? '') }}"
                            class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500" />
                        @error('website')
                            <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1"
                            for="location">Location</label>
                        <input id="location" name="location" type="text" required
                            value="{{ old('location', $company->location ?? '') }}"
                            class="w-full rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500" />
                        @error('location')
                            <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1" for="logo">Logo</label>
                        <div class="flex items-center gap-4">
                            @if ($company?->logo_path)
                                <img src="{{ asset('storage/' . $company->logo_path) }}" alt="Company logo"
                                    class="h-14 w-14 rounded-xl object-cover border border-gray-200 dark:border-gray-700">
                            @endif
                            <input id="logo" name="logo" type="file" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-xl file:border-0 file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100" />
                        </div>
                        <p class="text-xs text-gray-500 mt-1">PNG or JPG, max 2MB.</p>
                        @if ($company?->logo_path)
                            <label class="mt-2 inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                                Remove current logo
                            </label>
                        @endif
                        @error('logo')
                            <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1" for="about">About /
                        Description</label>
                    <textarea id="about" name="about" rows="5"
                        class="w-full rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ old('about', $company->about ?? '') }}</textarea>
                    @error('about')
                        <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('dashboard.home') }}"
                        class="px-4 py-2 rounded-xl border border-gray-300 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-amber-600 text-white px-5 py-2.5 text-sm font-semibold shadow-sm hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                        Save company
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
