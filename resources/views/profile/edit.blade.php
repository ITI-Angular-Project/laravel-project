<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
        @keyframes float-gentle {
            0%, 100% {
                transform: translate(0, 0);
            }
            25% {
                transform: translate(15px, -20px);
            }
            50% {
                transform: translate(-10px, -35px);
            }
            75% {
                transform: translate(-20px, -15px);
            }
        }

        @keyframes float-gentle-reverse {
            0%, 100% {
                transform: translate(0, 0);
            }
            25% {
                transform: translate(-15px, 20px);
            }
            50% {
                transform: translate(10px, 35px);
            }
            75% {
                transform: translate(20px, 15px);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.1);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-card {
            animation: fade-in-up 0.6s ease-out forwards;
        }

        .profile-card:nth-child(1) {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .profile-card:nth-child(2) {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .profile-card:nth-child(3) {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .floating-shape {
            animation: float-gentle 10s ease-in-out infinite;
        }

        .floating-shape-reverse {
            animation: float-gentle-reverse 12s ease-in-out infinite;
        }

        .pulsing-shape {
            animation: pulse-glow 6s ease-in-out infinite;
        }

        .floating-shape:nth-child(1) {
            animation-delay: 0s;
        }

        .floating-shape:nth-child(2) {
            animation-delay: 2s;
        }

        .floating-shape:nth-child(3) {
            animation-delay: 4s;
        }

        .floating-shape-reverse:nth-child(4) {
            animation-delay: 1s;
        }

        .floating-shape-reverse:nth-child(5) {
            animation-delay: 3s;
        }

        .pulsing-shape:nth-child(6) {
            animation-delay: 5s;
        }
    </style>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-amber-50/30 to-slate-50 dark:from-slate-950 dark:via-slate-900/95 dark:to-slate-950 relative overflow-hidden min-h-screen">

        {{-- Floating decorative shapes spread across entire background --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            {{-- Top left corner --}}
            <div class="floating-shape absolute top-10 left-10 w-80 h-80 bg-amber-400/20 dark:bg-amber-500/30 rounded-full blur-3xl"></div>

            {{-- Top right corner --}}
            <div class="floating-shape-reverse absolute top-20 right-20 w-96 h-96 bg-blue-400/15 dark:bg-blue-500/25 rounded-full blur-3xl"></div>

            {{-- Bottom left --}}
            <div class="floating-shape absolute bottom-10 left-1/4 w-72 h-72 bg-purple-400/10 dark:bg-purple-500/20 rounded-full blur-2xl"></div>

            {{-- Bottom right --}}
            <div class="floating-shape-reverse absolute bottom-20 right-10 w-96 h-96 bg-pink-400/10 dark:bg-pink-500/20 rounded-full blur-3xl"></div>

            {{-- Center floating --}}
            <div class="floating-shape-reverse absolute top-1/3 right-1/4 w-64 h-64 bg-indigo-400/10 dark:bg-indigo-500/20 rounded-full blur-2xl"></div>

            {{-- Pulsing center accent --}}
            <div class="pulsing-shape absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-400/5 dark:bg-amber-500/15 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Information Card --}}
            <div class="profile-card rounded-3xl border border-slate-200 bg-white/80 backdrop-blur-sm shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 dark:border-white/10 dark:bg-white/5 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500/10 to-transparent dark:from-amber-500/20 px-6 py-5 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white">Profile Information</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Update your account's profile information and email address.</p>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password Card --}}
            <div class="profile-card rounded-3xl border border-slate-200 bg-white/80 backdrop-blur-sm shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 dark:border-white/10 dark:bg-white/5 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500/10 to-transparent dark:from-amber-500/20 px-6 py-5 border-b border-slate-200 dark:border-white/10">
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white">Update Password</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="profile-card rounded-3xl border border-red-200 bg-white/80 backdrop-blur-sm shadow-sm transition-all duration-300 hover:shadow-xl hover:-translate-y-1 dark:border-red-900/30 dark:bg-white/5 overflow-hidden">
                <div class="bg-gradient-to-r from-red-500/10 to-transparent dark:from-red-500/20 px-6 py-5 border-b border-red-200 dark:border-red-900/30">
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white">Delete Account</h3>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
