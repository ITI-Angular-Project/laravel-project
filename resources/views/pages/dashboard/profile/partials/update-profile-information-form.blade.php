<section class="space-y-6">
    <header class="text-center mb-8">
        <h2
            class="text-3xl font-extrabold bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('dashboard.profile.update') }}"
        class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 p-8 rounded-2xl shadow-lg space-y-6 border border-gray-100 dark:border-gray-700">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Full Name') }}
            </label>
            <input id="name" name="name" type="text"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-200"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Email Address') }}
            </label>
            <input id="email" name="email" type="email"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition-all duration-200"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div
                    class="mt-3 p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg border border-yellow-200 dark:border-yellow-700">
                    <p class="text-sm text-yellow-700 dark:text-yellow-400">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                            class="ml-2 font-semibold underline hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-gray-50 dark:focus:ring-offset-gray-900 transition">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone Number --}}
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Phone Number') }}
            </label>
            <input id="phone" name="phone" type="text"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-200"
                value="{{ old('phone', $user->phone) }}" autocomplete="tel">
            @error('phone')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="linkedin_url" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                {{ __('Linkedin_URL') }}
            </label>
            <input id="linkedin_url" name="linkedin_url" type="text"
                class="w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all duration-200"
                value="{{ old('linkedin_url', $user->linkedin_url) }}" autocomplete="linkedin">
            @error('linkedin_url')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        {{-- Save Button --}}
        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold rounded-xl shadow-md hover:from-indigo-600 hover:to-pink-600 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 transition-all duration-200">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium">
                    {{ __('Saved!') }}
                </p>
            @endif
        </div>
    </form>
</section>
