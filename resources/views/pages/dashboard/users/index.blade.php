@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-2 md:flex-row md:items-start md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Users</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400">Manage account access and roles for your team.</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ $users->total() }} total users</p>
            </div>

            <div class="flex flex-wrap gap-3">
                <x-ui.button href="{{ route('dashboard.users.create') }}">New User</x-ui.button>
            </div>
        </div>

        <x-ui.filters :action="route('dashboard.users.index')" :filters="[
            ['type' => 'text', 'name' => 'search', 'label' => 'Keywords', 'placeholder' => 'Name or email'],
            [
                'type' => 'select',
                'name' => 'role',
                'label' => 'Role',
                'options' => [
                    '' => 'All roles',
                    \App\Models\User::ROLE_ADMIN => 'Admin',
                    \App\Models\User::ROLE_EMPLOYER => 'Employer',
                    \App\Models\User::ROLE_CANDIDATE => 'Candidate',
                ],
            ],
        ]" />

        @php($columns = [
            [
                'key' => 'name',
                'label' => 'User',
                'tdClass' => 'align-top',
                'format' => function ($row, $value) {
                    $name = e($value);
                    $email = e($row->email);


                    return '<div><div class="font-semibold text-gray-900 dark:text-gray-100">' .
                        $name .
                        '</div><div class="text-sm text-gray-500 dark:text-gray-400">' .
                        $email .
                        '</div></div>';
                },
            ],
            [
                'key' => 'role',
                'label' => 'Role',
                'tdClass' => 'align-middle',
                'format' => function ($row, $value) {
                    $map = [
                        \App\Models\User::ROLE_ADMIN => 'bg-emerald-100/80 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300',
                        \App\Models\User::ROLE_EMPLOYER => 'bg-blue-100/80 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                        \App\Models\User::ROLE_CANDIDATE => 'bg-purple-100/80 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300',
                    ];

                    $classes = $map[$value] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300';

                    return '<span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ' .
                        $classes .
                        '">' .
                        e(ucfirst($value)) .
                        '</span>';
                },
            ],
            [
                'key' => 'phone',
                'label' => 'Contact',
                'tdClass' => 'align-top',
                'format' => function ($row, $value) {
                    $phone = $value
                        ? '<div class="text-sm text-gray-800 dark:text-gray-200">' .
                            e($value) .
                            '</div>'
                        : '<div class="text-sm text-gray-400 dark:text-gray-500">No phone added</div>';

                    $linkedin = $row->linkedin_url
                        ? '<a href="' .
                            e($row->linkedin_url) .
                            '" target="_blank" rel="noopener" class="text-xs text-emerald-600 dark:text-emerald-300 hover:underline">LinkedIn profile</a>'
                        : '<div class="text-xs text-gray-400 dark:text-gray-500">No LinkedIn profile</div>';

                    return '<div class="space-y-1">' . $phone . $linkedin . '</div>';
                },
            ],
            [
                'key' => 'created_at',
                'label' => 'Joined',
                'tdClass' => 'align-middle text-sm text-gray-600 dark:text-gray-300',
                'format' => function ($row) {
                    return e(optional($row->created_at)->format('M d, Y'));
                },
            ],
            [
                'key' => 'actions',
                'label' => 'Actions',
                'tdClass' => 'w-px text-right',
                'format' => function ($row) {
                    return view('pages.dashboard.users.partials.actions', ['user' => $row])->render();
                },
            ],
        ])

        <x-ui.data-table :columns="$columns" :paginator="$users" />
    </div>
@endsection
