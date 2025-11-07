@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 space-y-6">
        <div>
            <x-ui.button href="{{ route('dashboard.users.index') }}" variant="secondary" size="sm">Back to Users</x-ui.button>
        </div>

        <div
            class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-xl p-8 space-y-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit User</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update account details and permissions for
                    {{ $user->name }}.</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                    Joined {{ optional($user->created_at)->format('M d, Y') ?? 'Not available' }}
                </p>
            </div>

            <form method="POST" action="{{ route('dashboard.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                @include('pages.dashboard.users.partials.form-fields', ['user' => $user, 'isEdit' => true])

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <span class="text-xs text-gray-400 dark:text-gray-500">
                        Last updated {{ optional($user->updated_at)->diffForHumans() ?? 'just now' }}
                    </span>

                    <div class="flex items-center gap-3">
                        <x-ui.button href="{{ route('dashboard.users.index') }}" variant="secondary">Cancel</x-ui.button>
                        <x-ui.button type="submit">Save changes</x-ui.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
