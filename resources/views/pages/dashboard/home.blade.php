@extends('layouts.dashboard.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Top metrics like the reference UI --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v8a2 2 0 002 2h10a2 2 0 002-2v-8"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalJobs }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Posted Job</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $acceptedJobs }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Accepted Jobs</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ number_format($applicationsThisMonth) }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Applications this month</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 flex items-center gap-4">
                    <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h6"/></svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $acceptedJobsThisMonth }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Accepted this month</div>
                    </div>
                </div>
            </div>

            {{-- Main panels: Job Views chart + Posted Jobs list --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                {{-- Job Views (simple SVG chart) --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Job Views</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Last 14 days</p>
                        </div>
                        <div class="text-xs text-gray-400 dark:text-gray-500">Total: {{ $viewsChartTotal }}</div>
                    </div>

                    <div class="rounded-xl border border-gray-100 dark:border-gray-700 p-4">
                        <canvas id="viewsChart" class="w-full h-48"></canvas>
                        @if ($viewsChartTotal === 0)
                            <p class="mt-3 text-center text-xs text-gray-500 dark:text-gray-400">No views recorded for this period yet.</p>
                        @endif
                </div>
                </div>

                {{-- Posted Jobs --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Posted Jobs</h3>
                    <div class="space-y-2">
                        @forelse($recentJobs as $job)
                            <div class="flex items-start gap-3 p-2 rounded-xl hover:bg-emerald-50 dark:hover:bg-gray-800 transition">
                                <div class="h-9 w-9 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-700 dark:text-emerald-300">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ strtoupper(substr($job->title,0,1)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('dashboard.jobs.show', $job->id) }}" class="font-medium text-gray-900 dark:text-gray-100 truncate hover:text-emerald-700">{{ $job->title }}</a>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $job->created_at?->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Applicants: {{ $job->applications_count ?? 0 }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="text-sm text-gray-500 dark:text-gray-400">No posted jobs yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@once
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js"></script>
@endonce

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('viewsChart');
        if (!canvas || typeof window.Chart === 'undefined') {
            return;
        }

        const dataPoints = @json($viewsChartData);
        const labels = @json($viewsChartLabels);
        const rawDates = @json($viewsChartDates);
        const breakdown = @json($viewsChartBreakdown);

        const ctx = canvas.getContext('2d');
        const gradientHeight = canvas.height || canvas.clientHeight || 200;
        const gradient = ctx.createLinearGradient(0, 0, 0, gradientHeight);
        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Views',
                    data: dataPoints,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#10b981',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 4,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#064e3b'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6b7280',
                            font: { size: 10 }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.12)'
                        },
                        ticks: {
                            precision: 0,
                            color: '#6b7280',
                            font: { size: 10 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        intersect: false,
                        mode: 'index',
                        backgroundColor: 'rgba(17, 24, 39, 0.85)',
                        titleColor: '#f9fafb',
                        bodyColor: '#f9fafb',
                        borderColor: 'rgba(55, 65, 81, 0.6)',
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: context => `Views: ${context.formattedValue}`,
                            afterBody: context => {
                                const dataIndex = context[0]?.dataIndex ?? 0;
                                const dateKey = rawDates[dataIndex] ?? null;
                                const jobs = dateKey ? breakdown[dateKey] ?? [] : [];
                                if (!jobs.length) {
                                    return 'No job views recorded';
                                }
                                return jobs.map(job => `• ${job.title}: ${job.count}`);
                            }
                        }
                    }
                }
            }
        });

        document.addEventListener('alpine:init', () => {
            document.addEventListener('theme-changed', () => chart.update());
        });
    });
</script>
