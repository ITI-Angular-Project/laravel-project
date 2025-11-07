@props([
    'columns' => [], // [ ['key' => 'title', 'label' => 'Title', 'class' => ''], ... ]
    'rows' => null, // paginator|collection of Eloquent models or arrays
    'paginator' => null,
])

@php
    $items = $rows ?? $paginator;
@endphp

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-2xl rounded-3xl border border-gray-200 dark:border-gray-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 uppercase text-xs tracking-wider">
            <tr>
                @foreach($columns as $col)
                    <th class="px-6 py-3 text-left {{ $col['class'] ?? '' }}">{{ $col['label'] ?? ucfirst($col['key']) }}</th>
                @endforeach
                @if (isset($actions))
                    <th class="px-6 py-3 text-center">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($items as $row)
                <tr class="group hover:bg-amber-50 dark:hover:bg-gray-800 transition">
                    @foreach($columns as $col)
                        @php($key = $col['key'])
                        @php($val = is_array($row) ? ($row[$key] ?? '') : (data_get($row, $key)))
                        <td class="px-6 py-4 {{ $col['tdClass'] ?? '' }}">{!! $col['format'] ?? false ? ($col['format']($row, $val) ?? $val) : e($val) !!}</td>
                    @endforeach
                    @if (isset($actions))
                        <td class="px-6 py-4"><div class="flex justify-center gap-3">{{ $actions }}</div></td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + (isset($actions) ? 1 : 0) }}" class="px-6 py-6 text-center text-gray-500 dark:text-gray-400">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($paginator && method_exists($paginator, 'hasPages') && $paginator->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $paginator->appends(request()->query())->links() }}
        </div>
    @endif
</div>


