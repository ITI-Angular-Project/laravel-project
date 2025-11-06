@props([
    'action' => '',
    'filters' => [], // array of [type, name, label, options?, value?]
])

<form method="GET" action="{{ $action }}" class="w-full">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
        @foreach($filters as $f)
            @php($type = $f['type'] ?? 'text')
            @php($name = $f['name'] ?? '')
            @php($label = $f['label'] ?? ucfirst($name))
            @php($value = request($name, $f['value'] ?? ''))
            <div>
                <label class="block text-xs font-semibold mb-1 text-gray-700 dark:text-gray-300">{{ $label }}</label>
                @if($type === 'select')
                    <select name="{{ $name }}" class="w-full px-3 py-2 rounded-xl border border-emerald-100 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-emerald-500/30">
                        @foreach(($f['options'] ?? []) as $optValue => $optLabel)
                            <option value="{{ $optValue }}" @selected($value == $optValue)>{{ $optLabel }}</option>
                        @endforeach
                    </select>
                @elseif($type === 'number')
                    <input type="number" name="{{ $name }}" value="{{ $value }}" class="w-full px-3 py-2 rounded-xl border border-emerald-100 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-emerald-500/30" />
                @elseif($type === 'date')
                    <input type="date" name="{{ $name }}" value="{{ $value }}" class="w-full px-3 py-2 rounded-xl border border-emerald-100 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-emerald-500/30" />
                @else
                    <input type="text" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $f['placeholder'] ?? '' }}" class="w-full px-3 py-2 rounded-xl border border-emerald-100 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-emerald-500/30" />
                @endif
            </div>
        @endforeach
    </div>
    <div class="mt-3 flex gap-2">
        <x-ui.button type="submit">Apply</x-ui.button>
        <x-ui.button href="{{ $action }}" variant="secondary">Reset</x-ui.button>
    </div>
</form>


