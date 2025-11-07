@props([
    'id' => null,
    'title' => 'Confirm Action',
    'description' => null,
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'confirmVariant' => 'danger',
    'triggerText' => 'Open Modal',
    'triggerVariant' => 'primary',
    'triggerSize' => 'md',
    'method' => 'POST',
    'action' => '#',
])

@php
    $modalId = $id ?? uniqid('modal-');
    $titleId = $modalId . '-title';
    $descriptionId = $modalId . '-description';
    $httpMethod = strtoupper($method);
    $spoofMethod = ! in_array($httpMethod, ['GET', 'POST']);
@endphp

<div x-data="{ open: false }" @keydown.window.escape="open = false" class="inline">
    <span @click="open = true" class="inline-flex">
        @isset($trigger)
            {{ $trigger }}
        @else
            <x-ui.button type="button" variant="{{ $triggerVariant }}" size="{{ $triggerSize }}">
                {{ $triggerText }}
            </x-ui.button>
        @endisset
    </span>

    <template x-teleport="body">
        <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-50">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="open = false"></div>

            <div class="relative flex min-h-full items-center justify-center p-4 sm:p-6">
                <div x-show="open" x-transition.scale.origin-center x-transition.opacity
                    class="w-full max-w-md rounded-3xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-2xl"
                    role="dialog" aria-modal="true" aria-labelledby="{{ $titleId }}" aria-describedby="{{ $descriptionId }}">
                    <form method="{{ $httpMethod === 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}" class="p-6 space-y-6"
                        @submit="open = false">
                        @if ($httpMethod !== 'GET')
                            @csrf
                        @endif

                        @if ($spoofMethod)
                            @method($httpMethod)
                        @endif

                        @isset($fields)
                            {{ $fields }}
                        @endisset

                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-rose-100 dark:bg-rose-900/40 text-rose-600 dark:text-rose-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v4m0 4h.01M4.93 19h14.14a2 2 0 001.94-2.5l-4.23-12A2 2 0 0014.93 3H9.07a2 2 0 00-1.85 1.5l-4.23 12A2 2 0 004.93 19z" />
                                </svg>
                            </div>
                            <div class="space-y-2">
                                <h2 id="{{ $titleId }}" class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $title }}
                                </h2>
                                @if ($description)
                                    <p id="{{ $descriptionId }}" class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $description }}
                                    </p>
                                @else
                                    <span id="{{ $descriptionId }}" class="sr-only">Confirmation dialog</span>
                                @endif

                                @if (! $slot->isEmpty())
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $slot }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end gap-3">
                            <x-ui.button type="button" variant="secondary" @click="open = false">
                                {{ $cancelText }}
                            </x-ui.button>
                            <x-ui.button type="submit" variant="{{ $confirmVariant }}">
                                {{ $confirmText }}
                            </x-ui.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
