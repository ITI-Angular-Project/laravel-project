<x-auth-layout>
    <div class="space-y-8 rounded-[36px] border border-slate-100 bg-white/95 p-8 shadow-2xl shadow-slate-900/10 backdrop-blur dark:border-white/10 dark:bg-slate-900/80">
        <div class="space-y-4">
            <div class="flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.45em] text-amber-500">
                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Welcome back
            </div>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">
                Keep your hiring momentum in one secure dashboard.
            </h1>
            <p class="text-base text-slate-500 dark:text-slate-300">
                Resume shortlists, sync feedback with your team, and re-engage prospects instantly with LinkedIn-powered updates.
            </p>
        </div>

        <div class="space-y-3">
            <a
                href="{{ route('auth.linkedin.redirect') }}"
                class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-[#0A66C2] to-[#004182] px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-[#0A66C2]/30 transition hover:translate-y-0.5 focus:outline-none focus-visible:ring-2 focus-visible:ring-[#0A66C2]/40"
            >
                <span class="inline-flex h-5 w-5 items-center justify-center">
                    <svg viewBox="0 0 34 34" role="img" aria-label="LinkedIn" class="h-5 w-5">
                        <g>
                            <path class="fill-[#0A66C2]" d="M34,17c0,9.4-7.6,17-17,17S0,26.4,0,17S7.6,0,17,0S34,7.6,34,17z"></path>
                            <path class="fill-white" d="M26.2 26.2h-3.6v-5.8c0-1.4 0-3.2-1.9-3.2s-2.2 1.5-2.2 3.1v5.9h-3.6V14h3.5v1.7h.1c.5-.9 1.8-1.9 3.7-1.9c4 0 4.8 2.6 4.8 5.9v6.5zM11 12.3c-1.2 0-2.1-1-2.1-2.1c0-1.2 1-2.1 2.1-2.1c1.2 0 2.1 1 2.1 2.1c0 1.2-0.9 2.1-2.1 2.1zm-1.8 13.9H12V14H9.2v12.2z"></path>
                        </g>
                    </svg>
                </span>
                Continue with LinkedIn
            </a>
            <p class="text-center text-xs font-medium uppercase tracking-[0.35em] text-slate-300 dark:text-slate-500">
                or use email
            </p>
        </div>

        <x-auth-session-status class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/40 dark:bg-emerald-500/10 dark:text-emerald-200" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Work email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="you@company.com"
                    class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white dark:placeholder:text-slate-500"
                />
                <x-input-error :messages="$errors->get('email')" class="text-sm text-rose-600" />
            </div>

            <div class="space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <label for="password" class="font-semibold text-slate-700 dark:text-slate-200">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-semibold text-amber-600 hover:text-amber-500">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-400/20 dark:border-slate-700 dark:bg-slate-900/60 dark:text-white dark:placeholder:text-slate-500"
                />
                <div class="flex items-center justify-between text-xs text-slate-400 dark:text-slate-500">
                    <span>Use 8+ characters with symbols.</span>
                    <span class="inline-flex items-center gap-1 text-emerald-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        TLS 1.3 secure
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="text-sm text-rose-600" />
            </div>

            <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                    <input
                        id="remember_me"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-amber-500 focus:ring-amber-500 dark:border-slate-600"
                    >
                    Keep me signed in
                </label>
                <div class="flex items-center gap-3 text-xs text-slate-400 dark:text-slate-500">
                    <span class="inline-flex items-center gap-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                        SSO available
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                        24/7 support
                    </span>
                </div>
            </div>

            <button
                type="submit"
                class="flex w-full items-center justify-center rounded-2xl bg-amber-500 px-5 py-3 text-sm font-semibold text-slate-950 shadow-lg shadow-amber-500/30 transition hover:translate-y-0.5 hover:bg-amber-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-400 focus-visible:ring-offset-2 dark:text-slate-900"
            >
                Log in
            </button>
        </form>

        <div class="grid gap-4 rounded-3xl border border-slate-100 bg-slate-50 p-5 text-sm text-slate-600 dark:border-slate-800 dark:bg-slate-900/60 dark:text-slate-300 sm:grid-cols-2">
            <div>
                <p class="font-semibold text-slate-900 dark:text-white">Why hire teams choose us</p>
                <ul class="mt-3 space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                        Unified inbox with AI nudges
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                        Real-time collaboration notes
                    </li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-slate-900 dark:text-white">Need help?</p>
                <p class="text-sm text-slate-500 dark:text-slate-400">Reach us at <span class="font-semibold text-slate-900 dark:text-white">support@hireon.com</span> or chat in-app.</p>
            </div>
        </div>

        <div class="text-center text-sm text-slate-500 dark:text-slate-400">
            @if (Route::has('register'))
                <p>
                    New to {{ config('app.name', 'Hireon') }}?
                    <a href="{{ route('register') }}" class="font-semibold text-amber-600 hover:text-amber-500">
                        Create an account
                    </a>
                </p>
            @endif
        </div>
    </div>
</x-auth-layout>
