@php($iconButton = 'inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-300 hover:border-amber-300 dark:hover:border-amber-600 transition focus:outline-none focus:ring-2 focus:ring-amber-500/40')
@php($dangerButton = 'inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-rose-500 dark:text-rose-300 hover:text-rose-600 dark:hover:text-rose-200 hover:border-rose-300 dark:hover:border-rose-600 transition focus:outline-none focus:ring-2 focus:ring-rose-500/40')
@php($actionButton = 'inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold text-white transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900')
@php($approveButton = $actionButton . ' bg-amber-600 hover:bg-amber-500 focus:ring-amber-500/40')
@php($rejectButton = $actionButton . ' bg-rose-600 hover:bg-rose-500 focus:ring-rose-500/40')
@php($user = auth()->user())

@if ($user && $user->hasRole(\App\Models\User::ROLE_ADMIN))
    <div class="flex items-center justify-end gap-2">
        @if ($job->status !== 'approved')
            <form method="POST" action="{{ route('dashboard.jobs.approve', $job) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="{{ $approveButton }}" aria-label="Approve {{ $job->title }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </form>
        @endif

        @if ($job->status !== 'rejected')
            <form method="POST" action="{{ route('dashboard.jobs.reject', $job) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="{{ $rejectButton }}" aria-label="Reject {{ $job->title }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m6 18 12-12M6 6l12 12" />
                    </svg>
                </button>
            </form>
        @endif
    </div>
@else
    <div class="flex items-center justify-end gap-2">
        <a href="{{ route('dashboard.jobs.edit', $job->id) }}" class="{{ $iconButton }}"
            aria-label="Edit {{ $job->title }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16.862 4.487 19.5 7.125m-3.463-2.638-9.193 9.193a4.5 4.5 0 0 0-1.177 2.06l-.647 2.583 2.583-.647a4.5 4.5 0 0 0 2.06-1.177l9.194-9.192m-3.463-2.638 3.463 3.463" />
            </svg>
            <span class="sr-only">Edit {{ $job->title }}</span>
        </a>

        <x-ui.confirm-modal :action="route('dashboard.jobs.destroy', $job->id)" method="DELETE" title="Delete Job"
            :description="__('Deleting this job will remove all associated applications and analytics.')"
            confirm-text="Delete Job" cancel-text="Cancel">
            <x-slot:trigger>
                <button type="button" class="{{ $dangerButton }}" aria-label="Delete {{ $job->title }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3m-7 0h18" />
                    </svg>
                    <span class="sr-only">Delete {{ $job->title }}</span>
                </button>
            </x-slot:trigger>
            <p>Please confirm you want to permanently remove this job posting.</p>
        </x-ui.confirm-modal>
    </div>
@endif
