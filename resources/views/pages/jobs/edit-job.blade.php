@extends('layouts.dashboard.app')

@section('content')
<div class="container mx-auto py-8">

    {{-- 🔙 زر العودة --}}
    <div class="mb-6">
        <a href="{{ route('jobs.index') }}"
            class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
            ← Back to My Jobs
        </a>
    </div>

    {{-- ✏️ تعديل الوظيفة --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-8 border border-gray-200 dark:border-gray-700">

        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Edit Job</h1>

        <form action="{{ route('jobs.update', $job->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Job Title --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Company --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Company</label>
                <select name="company_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" @selected(old('company_id', $job->company_id) == $company->id)>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Category --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category_id"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $job->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Work Type --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Work Type</label>
                <select name="work_type"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                    <option value="full_time" @selected(old('work_type', $job->work_type) == 'full_time')>Full Time</option>
                    <option value="part_time" @selected(old('work_type', $job->work_type) == 'part_time')>Part Time</option>
                    <option value="contract" @selected(old('work_type', $job->work_type) == 'contract')>Contract</option>
                    <option value="remote" @selected(old('work_type', $job->work_type) == 'remote')>Remote</option>
                </select>
            </div>

            {{-- Deadline --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline', $job->deadline->format('Y-m-d')) }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Salary --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Salary Min</label>
                    <input type="number" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}" step="0.01"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Salary Max</label>
                    <input type="number" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}" step="0.01"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            {{-- Technologies --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Technologies (comma separated)</label>
                <input type="text" name="technologies_txt" value="{{ old('technologies_txt', $job->technologies_txt) }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">{{ old('description', $job->description) }}</textarea>
            </div>

            {{-- Responsibilities --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Responsibilities</label>
                <textarea name="responsibilities" rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">{{ old('responsibilities', $job->responsibilities) }}</textarea>
            </div>

            {{-- Qualifications --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Qualifications</label>
                <textarea name="qualifications" rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">{{ old('qualifications', $job->qualifications) }}</textarea>
            </div>

            {{-- Benefits --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Benefits</label>
                <textarea name="benefits" rows="3"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">{{ old('benefits', $job->benefits) }}</textarea>
            </div>

            {{-- Submit --}}
            <div class="flex gap-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    Update Job
                </button>
                <a href="{{ route('jobs.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold px-5 py-2 rounded-lg transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
