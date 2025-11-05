@extends('layouts.dashboard.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-900 rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Post a New Job 💼</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Job Title</label>
                <input type="text" name="title" id="title"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. Frontend Developer" value="{{ old('title') }}" required>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Job Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Describe the job role and main responsibilities..." required>{{ old('description') }}</textarea>
            </div>

            <!-- Responsibilities -->
            <div>
                <label for="responsibilities" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Responsibilities</label>
                <textarea name="responsibilities" id="responsibilities" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="List key responsibilities">{{ old('responsibilities') }}</textarea>
            </div>

            <!-- Qualifications -->
            <div>
                <label for="qualifications" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Qualifications</label>
                <textarea name="qualifications" id="qualifications" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Required skills or experience">{{ old('qualifications') }}</textarea>
            </div>

            <!-- Benefits -->
            <div>
                <label for="benefits" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Benefits</label>
                <textarea name="benefits" id="benefits" rows="3"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Company perks or benefits">{{ old('benefits') }}</textarea>
            </div>

            <!-- Salary Range -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="salary_min" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Minimum Salary</label>
                    <input type="number" name="salary_min" id="salary_min"
                        class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3"
                        placeholder="e.g. 4000" value="{{ old('salary_min') }}">
                </div>
                <div>
                    <label for="salary_max" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Maximum Salary</label>
                    <input type="number" name="salary_max" id="salary_max"
                        class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3"
                        placeholder="e.g. 8000" value="{{ old('salary_max') }}">
                </div>
            </div>

            <!-- Work Type -->
            <div>
                <label for="work_type" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Work Type</label>
                <select name="work_type" id="work_type"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Select Type --</option>
                    <option value="remote" {{ old('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                    <option value="on_site" {{ old('work_type') == 'on_site' ? 'selected' : '' }}>On-site</option>
                    <option value="hybrid" {{ old('work_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                </select>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Category</label>
                <select name="category_id" id="category_id"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Deadline -->
            <div>
                <label for="deadline" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Application Deadline</label>
                <input type="date" name="deadline" id="deadline"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('deadline') }}" required>
            </div>

            <!-- Technologies -->
            <div>
                <label for="technologies_txt" class="block font-semibold mb-2 text-gray-800 dark:text-gray-200">Technologies</label>
                <input type="text" name="technologies_txt" id="technologies_txt"
                    class="w-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="e.g. Laravel, Vue.js, MySQL" value="{{ old('technologies_txt') }}">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition-all">
                    Publish Job 🚀
                </button>
            </div>
        </form>
    </div>
@endsection
