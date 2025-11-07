<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full"
                type="tel" name="phone" :value="old('phone')"
                required pattern="[0-9]{11}"
                title="Please enter a valid 11-digit phone number"
                autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role"
                class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm
                       focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-200">
                <option value="">Select role</option>
                <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Candidate Extra Fields -->
        <div id="candidateFields" class="hidden mt-4">
            <div>
                <x-input-label for="linkedin_url" :value="__('LinkedIn URL')" />
                <x-text-input id="linkedin_url" class="block mt-1 w-full"
                    type="url" name="linkedin_url" :value="old('linkedin_url')"
                    placeholder="https://www.linkedin.com/in/username" />
                <x-input-error :messages="$errors->get('linkedin_url')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="resume_path" :value="__('Upload CV')" />
                <input id="resume_path" type="file" name="resume_path"
                    class="block mt-1 w-full text-gray-700 dark:text-gray-300"
                    accept=".pdf,.doc,.docx" />
                <x-input-error :messages="$errors->get('resume_path')" class="mt-2" />
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400
                      hover:text-gray-900 dark:hover:text-gray-100 rounded-md
                      focus:outline-none focus:ring-2 focus:ring-offset-2
                      focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JS -->
    <script>
        const roleSelect = document.getElementById('role');
        const candidateFields = document.getElementById('candidateFields');

        function toggleCandidateFields() {
            if (roleSelect.value === 'candidate') {
                candidateFields.classList.remove('hidden');
            } else {
                candidateFields.classList.add('hidden');
            }
        }

        roleSelect.addEventListener('change', toggleCandidateFields);
        document.addEventListener('DOMContentLoaded', toggleCandidateFields);
    </script>
</x-guest-layout>
