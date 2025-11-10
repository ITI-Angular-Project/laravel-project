<x-auth-layout>
    <div class="space-y-8 rounded-[36px] border border-slate-100 bg-white/95 p-8 shadow-2xl shadow-slate-900/10 backdrop-blur dark:border-white/10 dark:bg-slate-900/80">
        <div class="space-y-3">
            <p class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.45em] text-amber-500">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Join Hireon
            </p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">
                Create your profile in minutes and start tracking roles.
            </h1>
            <p class="text-base text-slate-500 dark:text-slate-300">
                Whether you are hiring or applying, one account keeps conversations, applications, and updates in sync.
            </p>
        </div>

        <div class="space-y-3">
            <a href="{{ route('auth.linkedin.redirect') }}"
               class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-[#0A66C2] to-[#004182] px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-[#0A66C2]/30 transition hover:translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0A66C2]/40">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="h-5 w-5" aria-hidden="true" focusable="false">
                    <path fill="currentColor"
                          d="M100.3 448H7.4V149.9h92.9V448zM53.8 108.1C24.1 108.1 0 83.6 0 53.8 0 24 24.1 0 53.8 0s53.8 24.1 53.8 53.8c0 29.8-24.1 54.3-53.8 54.3zM447.9 448h-92.1V302.4c0-34.7-.7-79.2-48.3-79.2-48.4 0-55.8 37.8-55.8 76.9V448h-92.1V149.9h88.5v40.7h1.3c12.3-23.4 42.3-48.3 87.2-48.3 93.3 0 110.5 61.5 110.5 141.5V448z" />
                </svg>
                Sign up with LinkedIn
            </a>
            <p class="text-center text-xs font-medium uppercase tracking-[0.35em] text-slate-300 dark:text-slate-500">
                or create account manually
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Full name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                           class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white dark:placeholder:text-slate-500" />
                    <x-input-error :messages="$errors->get('name')" class="text-sm text-rose-600" />
                </div>
                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Work email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                           class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white dark:placeholder:text-slate-500" />
                    <x-input-error :messages="$errors->get('email')" class="text-sm text-rose-600" />
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="space-y-2">
                    <label for="phone" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Phone number</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required pattern="[0-9]{11}"
                           title="Please enter a valid 11-digit phone number" autocomplete="tel"
                           class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white" />
                    <x-input-error :messages="$errors->get('phone')" class="text-sm text-rose-600" />
                </div>
                <div class="space-y-2">
                    <label for="role" class="text-sm font-semibold text-slate-700 dark:text-slate-200">I am joining as</label>
                    <select id="role" name="role"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white">
                        <option value="">Select role</option>
                        <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                        <option value="candidate" {{ old('role') == 'candidate' ? 'selected' : '' }}>Candidate</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="text-sm text-rose-600" />
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white" />
                    <p class="text-xs text-slate-400 dark:text-slate-500">Use 8+ characters, numbers &amp; symbols.</p>
                    <x-input-error :messages="$errors->get('password')" class="text-sm text-rose-600" />
                </div>
                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Confirm password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-rose-600" />
                </div>
            </div>

            <div id="candidateFields" class="space-y-4 rounded-3xl border border-dashed border-amber-300/60 bg-amber-50/60 p-5 dark:border-amber-400/40 dark:bg-amber-400/10 {{ old('role') == 'candidate' ? '' : 'hidden' }}">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-amber-700 dark:text-amber-200">Candidate extras</p>
                    <span class="text-xs text-amber-500 dark:text-amber-300">Optional</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label for="linkedin_url" class="text-sm font-semibold text-slate-700 dark:text-slate-200">LinkedIn URL</label>
                        <input id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://www.linkedin.com/in/username"
                               class="w-full rounded-2xl border border-amber-200 bg-white px-4 py-3 text-sm text-slate-900 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-amber-400/60 dark:bg-slate-900/40 dark:text-white" />
                        <x-input-error :messages="$errors->get('linkedin_url')" class="text-sm text-rose-600" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-200">Upload CV (PDF/DOC)
                        </label>
                        <label for="resume_path" class="flex h-full cursor-pointer items-center justify-center rounded-2xl border-2 border-dashed border-amber-300 bg-white px-4 py-6 text-center text-sm text-slate-500 transition hover:border-amber-400 hover:bg-amber-50 dark:border-amber-400/60 dark:bg-slate-900/40 dark:text-slate-200">
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-white">Drop your file या browse</p>
                                <p class="text-xs text-slate-400 dark:text-slate-500">PDF, DOC, DOCX up to 5MB</p>
                            </div>
                            <input id="resume_path" type="file" name="resume_path" accept=".pdf,.doc,.docx" class="sr-only" />
                        </label>
                        <x-input-error :messages="$errors->get('resume_path')" class="text-sm text-rose-600" />
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 underline-offset-4 hover:text-slate-900 dark:text-slate-300">
                    Already have an account?
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-amber-500 px-6 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/30 transition hover:translate-y-0.5 hover:bg-amber-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:ring-offset-2 dark:text-slate-900">
                    Create account
                    <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const roleSelect = document.getElementById('role');
            const candidateFields = document.getElementById('candidateFields');

            const toggleCandidateFields = () => {
                if (roleSelect.value === 'candidate') {
                    candidateFields.classList.remove('hidden');
                } else {
                    candidateFields.classList.add('hidden');
                }
            };

            roleSelect.addEventListener('change', toggleCandidateFields);
            toggleCandidateFields();
        });
    </script>
</x-auth-layout>
