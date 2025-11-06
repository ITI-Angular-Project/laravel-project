@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8 space-y-6">
        <div>
            <x-ui.button href="{{ route('dashboard.users.index') }}" variant="secondary" size="sm">Back to Users</x-ui.button>
        </div>

        <div
            class="rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-xl p-8 space-y-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Create User</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Add a new teammate and assign the right role from
                    the start.</p>
            </div>

            <form method="POST" action="{{ route('dashboard.users.store') }}" class="space-y-6">
                @csrf

                @include('pages.dashboard.users.partials.form-fields', ['user' => null, 'isEdit' => false])

                <div class="flex items-center justify-end gap-3">
                    <x-ui.button type="submit">Create User</x-ui.button>
                    <x-ui.button href="{{ route('dashboard.users.index') }}" variant="secondary">Cancel</x-ui.button>
                </div>
            </form>
        </div>
    </div>
@endsection
