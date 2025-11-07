@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-amber-600 dark:text-amber-400']) }}>
        {{ $status }}
    </div>
@endif
