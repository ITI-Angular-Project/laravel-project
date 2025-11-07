@props([
    'user' => null,
    'isEdit' => false,
])

@php($inputClasses = 'w-full px-4 py-2.5 rounded-xl border border-amber-100 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-2 focus:ring-amber-500/30 focus:border-amber-500 transition')
@php($roleOptions = [
    \App\Models\User::ROLE_ADMIN => 'Admin',
    \App\Models\User::ROLE_EMPLOYER => 'Employer',
    \App\Models\User::ROLE_CANDIDATE => 'Candidate',
])

<div class="space-y-6">
    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Full name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required autofocus autocomplete="name"
            class="{{ $inputClasses }}" placeholder="Jane Doe" />
        @error('name')
            <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required autocomplete="email"
            class="{{ $inputClasses }}" placeholder="user@example.com" />
        @error('email')
            <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Password</label>
            <input id="password" type="password" name="password" @unless($isEdit) required @endunless autocomplete="new-password"
                class="{{ $inputClasses }}" placeholder="{{ $isEdit ? 'Leave blank to keep current password' : 'At least 8 characters' }}" />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                {{ $isEdit ? 'Leave blank to keep the current password.' : 'Use at least 8 characters.' }}
            </p>
            @error('password')
                <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" @unless($isEdit) required @endunless autocomplete="new-password"
                class="{{ $inputClasses }}" placeholder="Re-enter password" />
            @error('password_confirmation')
                <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Role and phone --}}
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label for="role" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Role</label>
            <select id="role" name="role" class="{{ $inputClasses }}" required>
                @foreach ($roleOptions as $value => $label)
                    <option value="{{ $value }}" @selected(old('role', $user->role ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('role')
                <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">Phone (optional)</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" autocomplete="tel"
                class="{{ $inputClasses }}" placeholder="+1 (555) 123-4567" />
            @error('phone')
                <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- LinkedIn --}}
    <div>
        <label for="linkedin_url" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">LinkedIn profile (optional)</label>
        <input id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url ?? '') }}" autocomplete="url"
            class="{{ $inputClasses }}" placeholder="https://linkedin.com/in/username" />
        @error('linkedin_url')
            <p class="mt-2 text-sm text-rose-500 dark:text-rose-400">{{ $message }}</p>
        @enderror
    </div>
</div>
