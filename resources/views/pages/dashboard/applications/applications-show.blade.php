@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <x-ui.button href="{{ route('dashboard.applications.index') }}" variant="secondary" size="sm">← Back</x-ui.button>
            <div class="flex gap-2">
                <form method="POST" action="{{ route('dashboard.applications.update', $application->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="accept" {{ $application->status === 'accepted' ? 'disabled' : '' }}>
                    <x-ui.button :disabled="$application->status === 'accepted'" :type="'submit'" size="sm">Accept</x-ui.button>
                </form>
                <form method="POST" action="{{ route('dashboard.applications.update', $application->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="action" value="decline">
                    <x-ui.button :disabled="$application->status === 'rejected'" :type="'submit'" size="sm" variant="danger">Decline</x-ui.button>
                </form>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 shadow-xl p-6">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">{{ $application->applicant_name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-gray-500">Email</div>
                    <div class="font-medium">{{ $application->applicant_email }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Phone</div>
                    <div class="font-medium">{{ $application->applicant_phone ?: '—' }}</div>
                </div>
                <div>
                    <div class="text-gray-500">LinkedIn</div>
                    <div class="font-medium"><a class="text-amber-700 dark:text-amber-300 hover:underline" href="{{ $application->linkedin_url }}" target="_blank">{{ $application->linkedin_url ?: '—' }}</a></div>
                </div>
                <div>
                    <div class="text-gray-500">Applied</div>
                    <div class="font-medium">{{ $application->created_at->diffForHumans() }}</div>
                </div>
                <div>
                    <div class="text-gray-500">Status</div>
                    <div class="font-medium w-max text-xs px-3 py-1 rounded-full {{ $application->status === 'accepted' ? 'bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-100' : 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100' }}">{{ ucfirst($application->status) }}</div>
                </div>
            </div>

            <div class="mt-6">
                <div class="text-gray-500">For Job</div>
                <a href="{{ route('dashboard.jobs.show', $application->job->id) }}" class="font-medium hover:text-amber-700 dark:hover:text-amber-300">{{ $application->job->title }}</a>
            </div>

            @if($application->cover_letter)
            <div class="mt-6">
                <div class="text-gray-500 mb-2">Cover Letter</div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-700 p-4 text-sm text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $application->cover_letter }}</div>
            </div>
            @endif
        </div>
    </div>
@endsection

