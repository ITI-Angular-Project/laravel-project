@extends('layouts.main.app')

@section('content')
    <div class="container mx-auto py-10">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                Complete Your Profile to Apply
            </h2>

            <form action="{{ route('apply.submit-profile', $job->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                {{-- Phone --}}
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Phone Number *
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700
                              dark:bg-gray-800 dark:text-gray-200 px-4 py-2"
                        required />
                    @error('phone')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Resume --}}
                <div>
                    <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Upload Resume {{ auth()->user()->resume_path ? '(optional)' : '*' }}
                    </label>
                    <input type="file" name="resume" accept=".pdf,.doc,.docx"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700
                              dark:bg-gray-800 dark:text-gray-200 px-4 py-2" />

                    @if (auth()->user()->resume_path)
                        <p class="text-sm text-green-600 mt-1">✅ Existing Resume detected</p>
                    @endif

                    @error('resume')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    class="w-full bg-amber-500 hover:bg-amber-400
                           text-black py-3 rounded-xl font-semibold">
                    Submit & Apply
                </button>
            </form>
        </div>
    </div>
@endsection
