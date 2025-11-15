@extends('layouts.dashboard.app')

@section('content')
    <div class="container mx-auto ">

        {{-- dY"1 Title + Filters + New Job --}}
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">My Jobs</h2>
                @can('employer-view')
                <x-ui.button href="{{ route('dashboard.jobs.create') }}" size="md">New Job</x-ui.button>
                @endcan
            </div>

            <x-ui.filters :action="route('dashboard.jobs.index')" :filters="[
                ['type' => 'text', 'name' => 'search', 'label' => 'Keywords', 'placeholder' => 'Title or description'],
                [
                    'type' => 'select',
                    'name' => 'status',
                    'label' => 'Status',
                    'options' => [
                        '' => 'All',
                        'approved' => 'Approved',
                        'pending' => 'Pending',
                        'rejected' => 'Rejected',
                    ],
                ],
                [
                    'type' => 'select',
                    'name' => 'date_posted',
                    'label' => 'Date Posted',
                    'options' => ['' => 'Any time', '24h' => 'Last 24h', '7d' => 'Last 7d', '30d' => 'Last 30d'],
                ],
            ]" />
        </div>

        @php(
    $columns = [
        [
            'key' => 'title',
            'label' => 'Title',
            'tdClass' => 'text-gray-800 dark:text-gray-100 font-medium',
            'format' => function ($row, $value) {
                return '<a href="' . route('dashboard.jobs.show', $row->id) . '" class="text-black dark:text-white hover:text-amber-500 dark:hover:text-amber-200 font-semibold transition">' . e($value) . '</a>';
            },
        ],
        [
            'key' => 'work_type',
            'label' => 'Work Type',
            'format' => function ($row, $v) {
                return e(ucwords(str_replace('_', ' ', $v)));
            },
        ],
        [
            'key' => 'salary',
            'label' => 'Salary',
            'format' => function ($row) {
                if ($row->salary_min && $row->salary_max) {
                    return '$' . $row->salary_min . ' - $' . $row->salary_max;
                }
                return '<span class="text-gray-400">Not specified</span>';
            },
        ],
        [
            'key' => 'deadline',
            'label' => 'Deadline',
            'format' => function ($row) {
                return e(\Carbon\Carbon::parse($row->deadline)->format('Y-m-d'));
            },
        ],
        [
            'key' => 'status',
            'label' => 'Status',
            'format' => function ($row) {
                $classes = 'px-3 py-1 rounded-full text-xs font-semibold ';
                if ($row->status === 'approved') {
                    $classes .= 'bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-100';
                } elseif ($row->status === 'pending') {
                    $classes .= 'bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100';
                } else {
                    $classes .= 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100';
                }
                return '<span class="' . $classes . '">' . e(ucfirst($row->status)) . '</span>';
            },
        ],
        [
            'key' => 'actions',
            'label' => 'Actions',
            'tdClass' => 'w-px text-right',
            'format' => function ($row) {
                return view('pages.dashboard.jobs.partials.actions', ['job' => $row])->render();
            },
        ],
    ]
)

        <x-ui.data-table :columns="$columns" :rows="$jobs" :paginator="$jobs" />

    </div>
@endsection

