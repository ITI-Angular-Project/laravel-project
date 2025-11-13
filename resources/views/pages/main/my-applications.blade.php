@extends('layouts.main.app')
@section('title', 'My Applications')
@section('content')
<style>
    @keyframes gradient-shift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }
    
    .animated-gradient-bg {
        background: linear-gradient(
            -45deg,
            #f8fafc,
            #eff6ff,
            #eef2ff,
            #faf5ff,
            #f0fdfa
        );
        background-size: 400% 400%;
        animation: gradient-shift 15s ease infinite;
    }
    
    .dark .animated-gradient-bg {
        background: linear-gradient(
            -45deg,
            #0f172a,
            #1e293b,
            #1e1b4b,
            #312e81,
            #134e4a
        );
        background-size: 400% 400%;
        animation: gradient-shift 15s ease infinite;
    }
    
    @keyframes float-blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -30px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }
    
    .floating-blob {
        animation: float-blob 20s ease-in-out infinite;
    }
</style>

<div class="container mx-auto py-6 px-4 md:px-0 max-w-6xl">
    
    @if ($applications->isEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-700 text-center">
            <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p class="text-gray-500 dark:text-gray-400 font-medium">You haven't applied to any jobs yet.</p>
        </div>
    @else
        <div class="animated-gradient-bg rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/50 overflow-hidden hover:shadow-2xl transition-all duration-300">
            
            {{-- Header with gradient background --}}
            <div class="relative bg-amber-600/10 dark:bg-amber-600/10 p-5 overflow-hidden ring-1 ring-inset ring-amber-600/20">
                {{-- Decorative animated blurred corner accents --}}
                <div class="absolute top-0 left-0 w-32 h-32 rounded-full blur-2xl floating-blob" style="background-color: oklch(75% 0.183 55.934 / 0.5); animation-delay: 0s;"></div>
                <div class="absolute bottom-0 right-0 w-40 h-40 rounded-full blur-3xl floating-blob" style="background-color: oklch(75% 0.183 55.934 / 0.35); animation-delay: 7s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 rounded-full blur-xl floating-blob" style="background-color: oklch(75% 0.183 55.934 / 0.25); animation-delay: 14s;"></div>
                
                <div class="relative z-10">
                    <h1 class="text-2xl md:text-3xl font-bold text-amber-700 dark:text-amber-300 tracking-tight drop-shadow-sm">
                        My Applications
                        <span class="ml-2 text-lg font-semibold text-amber-600 dark:text-amber-400">({{ $applications->count() }})</span>
                    </h1>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="p-5">
                <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="relative bg-amber-600/10 dark:bg-amber-600/10 overflow-hidden ring-1 ring-inset ring-amber-600/20">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-amber-700 dark:text-amber-300">Job Title</th>
                                <th class="px-4 py-3 text-left font-bold text-amber-700 dark:text-amber-300">Applied On</th>
                                <th class="px-4 py-3 text-left font-bold text-amber-700 dark:text-amber-300">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($applications as $app)
                                <tr class="hover:bg-amber-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <td class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $app->job->title ?? 'Job Deleted' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        {{ $app->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($app->status === 'accepted')
                                                bg-green-600/10 text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20
                                            @elseif ($app->status === 'rejected')
                                                bg-red-600/10 text-red-700 dark:text-red-300 ring-1 ring-inset ring-red-600/20
                                            @else
                                                bg-yellow-400 text-gray-900 shadow-yellow-400/30
                                            @endif
                                        ">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection