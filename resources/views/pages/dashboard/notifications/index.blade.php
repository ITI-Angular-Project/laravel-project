@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-widest text-amber-500 font-semibold">Inbox</p>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Notifications</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">All updates about your jobs appear here.</p>
            </div>
        </div>

        @if ($allNotifications->isEmpty())
            <div
                class="rounded-2xl border border-dashed border-gray-200 dark:border-gray-800 bg-white/60 dark:bg-gray-900/40 px-6 py-10 text-center">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Nothing to see right now</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Approvals, rejections, or other alerts will show
                    up once actions are taken.</p>
            </div>
        @else
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($allNotifications as $notification)
                    <a href="{{ $notification->data['url'] ?? '#' }}"
                        class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 px-6 py-4 hover:bg-amber-50/40 dark:hover:bg-amber-500/10 transition">
                        <div class="space-y-1">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $notification->data['title'] ?? 'Notification' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $notification->data['message'] ?? '' }}
                            </p>
                        </div>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div>
                {{ $allNotifications->links() }}
            </div>
        @endif
    </div>
@endsection
