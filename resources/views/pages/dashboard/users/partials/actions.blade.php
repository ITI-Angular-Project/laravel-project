@php($isCurrentUser = auth()->id() === $user->id)

@php($iconButton = 'inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400 hover:text-emerald-500 dark:hover:text-emerald-300 hover:border-emerald-300 dark:hover:border-emerald-600 transition focus:outline-none focus:ring-2 focus:ring-emerald-500/40')
@php($dangerButton = 'inline-flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-rose-500 dark:text-rose-300 hover:text-rose-600 dark:hover:text-rose-200 hover:border-rose-300 dark:hover:border-rose-600 transition focus:outline-none focus:ring-2 focus:ring-rose-500/40')

<div class="flex items-center justify-end gap-2">
    <a href="{{ route('dashboard.users.edit', $user) }}" class="{{ $iconButton }}" aria-label="Edit {{ $user->name }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16.862 4.487 19.5 7.125m-3.463-2.638-9.193 9.193a4.5 4.5 0 0 0-1.177 2.06l-.647 2.583 2.583-.647a4.5 4.5 0 0 0 2.06-1.177l9.194-9.192m-3.463-2.638 3.463 3.463" />
        </svg>
        <span class="sr-only">Edit {{ $user->name }}</span>
    </a>

    @if ($isCurrentUser)
        <span class="text-xs text-gray-400 dark:text-gray-500">This is you</span>
    @else
        <x-ui.confirm-modal :action="route('dashboard.users.destroy', $user)" method="DELETE"
            title="Delete User" :description="__('This will permanently delete the user account and remove dashboard access.')"
            confirm-text="Delete" cancel-text="Cancel">
            <x-slot:trigger>
                <button type="button" class="{{ $dangerButton }}" aria-label="Delete {{ $user->name }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3m-7 0h18" />
                    </svg>
                    <span class="sr-only">Delete {{ $user->name }}</span>
                </button>
            </x-slot:trigger>
            <p>This action cannot be undone.</p>
        </x-ui.confirm-modal>
    @endif
</div>
