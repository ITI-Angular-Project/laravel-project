@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-6xl mx-auto space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Categories</h2>
                <p class="text-gray-600 dark:text-gray-400">Organize job postings into clear groups for candidates.</p>
            </div>
            <div class="flex gap-3 justify-end">
                <x-ui.button href="{{ route('dashboard.categories.create') }}" size="md">
                    New Category
                </x-ui.button>
            </div>
        </div>

        <x-ui.filters :action="route('dashboard.categories.index')" :filters="[
            [
                'type' => 'text',
                'name' => 'search',
                'label' => 'Search',
                'placeholder' => 'Name or slug',
            ],
            [
                'type' => 'select',
                'name' => 'sort',
                'label' => 'Sort By',
                'options' => [
                    'latest' => 'Newest first',
                    'oldest' => 'Oldest first',
                    'name_asc' => 'Name A-Z',
                    'name_desc' => 'Name Z-A',
                ],
                'value' => request('sort', 'latest'),
            ],
        ]" />

        @php(
            $columns = [
                [
                    'key' => 'name',
                    'label' => 'Name',
                    'tdClass' => 'text-gray-900 dark:text-gray-100 font-semibold',
                    'format' => fn($row, $value) => e($value),
                ],
                [
                    'key' => 'slug',
                    'label' => 'Slug',
                    'tdClass' => 'font-mono text-sm text-gray-500 dark:text-gray-400',
                    'format' => fn($row, $value) => e($value),
                ],
                [
                    'key' => 'jobs_count',
                    'label' => 'Jobs',
                    'tdClass' => 'text-sm text-gray-700 dark:text-gray-300',
                    'format' => fn($row, $value) => e(number_format((int) $value)),
                ],
                [
                    'key' => 'created_at',
                    'label' => 'Created',
                    'tdClass' => 'text-sm text-gray-700 dark:text-gray-300 whitespace-nowrap',
                    'format' => fn($row, $value) => e(optional($row->created_at)->format('M d, Y')),
                ],
                [
                    'key' => 'actions',
                    'label' => 'Actions',
                    'tdClass' => 'w-px text-right',
                    'format' => fn($row) => view('pages.dashboard.categories.partials.actions', ['category' => $row])->render(),
                ],
            ]
        )

        <x-ui.data-table :columns="$columns" :paginator="$categories" />
    </div>
@endsection
