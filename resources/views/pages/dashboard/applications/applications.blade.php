@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Applications</h2>
        </div>

        <x-ui.filters :action="route('dashboard.applications.index')" :filters="[
            ['type' => 'text','name'=>'search','label'=>'Search','placeholder'=>'Name or email'],
            ['type' => 'select','name'=>'status','label'=>'Status','options'=>[''=>'All','submitted'=>'Submitted','accepted'=>'Accepted','rejected'=>'Rejected']],
        ]" />

        @php($columns = [
            ['key' => 'applicant_name', 'label' => 'Applicant', 'format' => function($row,$v){
                return '<a href="'.route('dashboard.applications.show', $row->id).'" class="hover:text-amber-700 dark:hover:text-amber-300">'.e($row->applicant_name).'</a> <div class="text-xs text-gray-500">'.e($row->applicant_email).'</div>';
            }],
            ['key' => 'job.title', 'label' => 'Job', 'format' => function($row){
                return '<a href="'.route('dashboard.jobs.show', $row->job->id).'" class="hover:text-amber-700 dark:hover:text-amber-300">'.e($row->job->title).'</a>';
            }],
            ['key' => 'status', 'label' => 'Status', 'format' => function($row){
                $classes='px-3 py-1 rounded-full text-xs font-semibold ';
                if($row->status==='accepted'){$classes.='bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-100';}
                elseif($row->status==='submitted'){$classes.='bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-100';}
                else{$classes.='bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-100';}
                return '<span class="'.$classes.'">'.e(ucfirst($row->status)).'</span>';
            }],
            ['key' => 'created_at', 'label' => 'Applied', 'format' => function($row){ return e($row->created_at->diffForHumans()); }],
            ['key' => 'actions', 'label' => 'Actions', 'format' => function($row) {
    $acceptUrl  = route('dashboard.applications.update', $row->id);
    $declineUrl = $acceptUrl;
    $token      = csrf_token();

    // Disable conditions
    $isAccepted = $row->status === 'accepted';
    $isDeclined = $row->status === 'rejected';

    // CSS classes (disabled buttons look dim and not clickable)
    $baseButton = 'px-3 py-1.5 text-xs rounded-lg text-white transition';
    $acceptClass = $baseButton . ($isAccepted ? ' bg-amber-400 cursor-not-allowed opacity-50' : ' bg-amber-600 hover:bg-amber-700');
    $declineClass = $baseButton . ($isDeclined ? ' bg-rose-400 cursor-not-allowed opacity-50' : ' bg-rose-600 hover:bg-rose-700');

    // HTML output
    return '
        <div class="flex gap-2">
            <form method="POST" action="'.$acceptUrl.'">
                <input type="hidden" name="_token" value="'.$token.'" />
                <input type="hidden" name="_method" value="PUT" />
                <input type="hidden" name="action" value="accept" />
                <button type="submit" class="'.$acceptClass.'" '.($isAccepted ? 'disabled' : '').'>Accept</button>
            </form>
            <form method="POST" action="'.$declineUrl.'">
                <input type="hidden" name="_token" value="'.$token.'" />
                <input type="hidden" name="_method" value="PUT" />
                <input type="hidden" name="action" value="decline" />
                <button type="submit" class="'.$declineClass.'" '.($isDeclined ? 'disabled' : '').'>Decline</button>
            </form>
        </div>
    ';
}],
        ])

        <div class="mt-4">
            <x-ui.data-table :columns="$columns" :rows="$applications" :paginator="$applications" />
        </div>
    </div>
@endsection
