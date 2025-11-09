<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="font-bold text-3xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                {{ __('My Profile') }}
            </h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Manage your account information</p>
        </div>
    </x-slot>

    <div
        class="py-12 bg-gradient-to-br from-indigo-100 via-white to-pink-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- Update Profile Info --}}
            <div
                class="relative p-6 sm:p-10 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl transition transform hover:scale-[1.01] hover:shadow-2xl duration-300">
                <div
                    class="absolute -top-4 left-6 bg-gradient-to-r from-indigo-500 to-pink-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    Profile Info
                </div>
                <div class="max-w-2xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div
                class="relative p-6 sm:p-10 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl transition transform hover:scale-[1.01] hover:shadow-2xl duration-300">
                <div
                    class="absolute -top-4 left-6 bg-gradient-to-r from-green-400 to-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    Password
                </div>
                <div class="max-w-2xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div
                class="relative p-6 sm:p-10 bg-white dark:bg-gray-800 shadow-xl sm:rounded-2xl transition transform hover:scale-[1.01] hover:shadow-2xl duration-300">
                <div
                    class="absolute -top-4 left-6 bg-gradient-to-r from-red-500 to-pink-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    Danger Zone
                </div>
                <div class="max-w-2xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
