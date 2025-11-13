<section>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 mb-6">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-amber-600 dark:text-amber-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                :value="old('phone', $user->phone)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        {{-- LinkedIn URL --}}
        <div>
            <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
            <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full"
                :value="old('linkedin_url', $user->linkedin_url)" autocomplete="url" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
        </div>

        {{-- Resume Upload --}}
        <div>
            <x-input-label for="resume_path" :value="__('Resume (CV)')" />
            <input id="resume_path" name="resume_path" type="file" accept=".pdf,.doc,.docx"
                class="mt-1 block w-full text-gray-900 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg p-2 bg-white dark:bg-gray-700 focus:border-amber-500 dark:focus:border-amber-400 focus:ring-amber-500 dark:focus:ring-amber-400" />

            @if ($user->resume_path)
                <p class="text-sm text-green-600 dark:text-green-400 mt-1">
                     Current file: <a href="{{ asset('storage/' . $user->resume_path) }}" class="underline text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300" target="_blank">View CV</a>
                </p>
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('resume_path')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-amber-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-amber-600 dark:text-amber-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>