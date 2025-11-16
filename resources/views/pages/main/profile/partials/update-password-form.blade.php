<section class="space-y-6">
    <header class="text-center mb-8">
        <h2
            class="text-3xl font-extrabold bg-gradient-to-r from-green-500 via-teal-500 to-blue-500 bg-clip-text text-transparent">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
            {{ __('Ensure your account uses a strong and unique password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}"
        class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 p-8 rounded-2xl shadow-lg space-y-6 border border-gray-100 dark:border-gray-700">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <label for="update_password_current_password"
                class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Current Password') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200"
                autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <p class="mt-2 text-sm text-red-500">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        {{-- New Password --}}
        <div>
            <label for="update_password_password"
                class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('New Password') }}
            </label>
            <input id="update_password_password" name="password" type="password"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-green-400 focus:border-green-400 transition-all duration-200"
                autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <p class="mt-2 text-sm text-red-500">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        {{-- Confirm Password --}}
        <div>
            <label for="update_password_password_confirmation"
                class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Confirm New Password') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all duration-200"
                autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="mt-2 text-sm text-red-500">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        {{-- Save Button --}}
        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-blue-500 text-white font-semibold rounded-xl shadow-md hover:from-green-600 hover:to-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-all duration-200">
                {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium">
                    {{ __('Saved!') }}
                </p>
            @endif
        </div>
    </form>
</section>
