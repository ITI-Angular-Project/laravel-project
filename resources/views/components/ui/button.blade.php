@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, outline, subtle
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'disabled' => false,
])

@php
    $sizes = [
        'sm' => 'px-3 py-1.5 text-sm rounded-lg',
        'md' => 'px-4 py-2 text-sm rounded-xl',
        'lg' => 'px-5 py-3 text-base rounded-2xl',
    ];

    $variants = [
        'primary' => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm',
        'secondary' =>
            'bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-200',
        'danger' => 'bg-rose-600 hover:bg-rose-700 text-white shadow-sm',
        'outline' =>
            'border border-emerald-500 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/20',
        'subtle' =>
            'bg-white hover:bg-gray-50 dark:bg-gray-900 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200',
    ];

    $base =
        'inline-flex items-center gap-2 font-medium transition focus:outline-none focus:ring-2 focus:ring-emerald-500/40';
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $classes = trim("$base $sizeClass $variantClass");
    if ($disabled) {
        $classes .= ' opacity-50 cursor-not-allowed';
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <span class="h-5 w-5">{!! $icon !!}</span>
        @endif
        <span>{{ $slot }}</span>
    </a>
@else
    <button type="{{ $type }}" @if ($disabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <span class="h-5 w-5">{!! $icon !!}</span>
        @endif
        <span>{{ $slot }}</span>
    </button>
@endif
