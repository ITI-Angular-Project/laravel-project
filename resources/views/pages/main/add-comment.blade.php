{{-- @extends('layouts.main.app')

@section('content')
    <div class="container mx-auto py-10 px-4 md:px-0 max-w-2xl">

        <div class="mb-6">
            <a href="{{ url()->previous() }}"
                class="text-sm text-amber-600 hover:text-amber-500 font-semibold flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Jobs
            </a>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Add a Comment for "{{ $job->title }}"
            </h1>

            <form action="{{ route('jobs.comment.store', $job->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Your Comment
                    </label>
                    <textarea name="content" id="content" rows="5"
                        class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:ring-amber-400 focus:border-amber-400"
                        placeholder="Write your thoughts here..."></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-blue-500 px-6 py-3 text-lg font-semibold text-white hover:bg-blue-400 transition">
                        Submit Comment
                    </button>
                </div>
            </form>


        </div>

    </div>
@endsection --}}
