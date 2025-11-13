@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-3xl mx-auto space-y-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-widest text-amber-600 font-semibold">Admin</p>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Create Category</h2>
                <p class="text-gray-600 dark:text-gray-400">Add a new classification candidates can filter by.</p>
            </div>
            <x-ui.button href="{{ route('dashboard.categories.index') }}" variant="secondary">
                Back
            </x-ui.button>
        </div>

        <form method="POST" action="{{ route('dashboard.categories.store') }}"
            class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-800 p-6 space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-2">
                    Category Name
                </label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="120"
                    class="w-full px-4 py-3 rounded-2xl border border-amber-100 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-amber-500/40"
                    placeholder="e.g. Backend Development" required>
                @error('name')
                    <p class="text-sm text-rose-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <x-ui.button href="{{ route('dashboard.categories.index') }}" variant="secondary">
                    Cancel
                </x-ui.button>
                <x-ui.button type="submit">
                    Create Category
                </x-ui.button>
            </div>
        </form>
    </div>
@endsection
