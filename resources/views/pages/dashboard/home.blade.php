@extends('layouts.dashboard.app')

@section('content')
    <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl p-4 bg-white dark:bg-gray-900 border border-gray-200/80 dark:border-gray-800 shadow-sm">
            <div class="text-sm text-gray-500 dark:text-gray-400">Open Jobs</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight">12</div>
        </div>
        <div class="rounded-2xl p-4 bg-white dark:bg-gray-900 border border-gray-200/80 dark:border-gray-800 shadow-sm">
            <div class="text-sm text-gray-500 dark:text-gray-400">New Applications</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight">37</div>
        </div>
        <div class="rounded-2xl p-4 bg-white dark:bg-gray-900 border border-gray-200/80 dark:border-gray-800 shadow-sm">
            <div class="text-sm text-gray-500 dark:text-gray-400">Interviews</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight">5</div>
        </div>
        <div class="rounded-2xl p-4 bg-white dark:bg-gray-900 border border-gray-200/80 dark:border-gray-800 shadow-sm">
            <div class="text-sm text-gray-500 dark:text-gray-400">Hires</div>
            <div class="mt-2 text-3xl font-semibold tracking-tight">2</div>
        </div>
    </div>
@endsection
