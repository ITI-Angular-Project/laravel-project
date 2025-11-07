@extends('layouts.main.app')

@section('content')
    <div class="bg-gradient-to-b from-white via-slate-50 to-white dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0" aria-hidden="true">
                <div class="h-full w-full bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.12),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(16,185,129,0.12),_transparent_35%)] dark:bg-[radial-gradient(circle_at_top,_rgba(59,130,246,0.25),_transparent_45%),_radial-gradient(circle_at_bottom,_rgba(16,185,129,0.35),_transparent_35%)]"></div>
            </div>

            <div class="relative mx-auto max-w-5xl px-4 py-16 text-center sm:px-6 lg:px-8">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-slate-900/5 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-slate-600 dark:bg-white/10 dark:text-emerald-200">
                    We're here to help
                </span>
                <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-5xl">
                    Let’s design your next hiring win
                </h1>
                <p class="mt-3 text-base text-slate-600 dark:text-slate-300 sm:text-lg">
                    Reach out for platform support, talent partnerships, or to join the HireOn collective.
                </p>
                @if (session('success'))
                    <p class="mt-4 inline-flex items-center rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-600 dark:text-emerald-200">
                        {{ session('success') }}
                    </p>
                @endif
            </div>
        </section>

        <section class="mx-auto max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-[1fr_1.2fr]">
                <!-- Contact info -->
                <div class="space-y-6">
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/5">
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Talk to a specialist</h2>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                            Share a few details and we’ll route your message to the right person within hours.
                        </p>
                        <dl class="mt-6 space-y-4 text-sm text-slate-600 dark:text-slate-300">
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100">
                                    📧
                                </span>
                                <div>
                                    <dt class="font-semibold text-slate-900 dark:text-white">Email</dt>
                                    <dd>hello@hireon.io</dd>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100">
                                    📞
                                </span>
                                <div>
                                    <dt class="font-semibold text-slate-900 dark:text-white">Phone</dt>
                                    <dd>+20 106 000 0000</dd>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100">
                                    🌍
                                </span>
                                <div>
                                    <dt class="font-semibold text-slate-900 dark:text-white">Offices</dt>
                                    <dd>Remote-first — Cairo, Berlin, Dubai</dd>
                                </div>
                            </div>
                        </dl>
                    </article>

                    <div class="rounded-3xl border border-slate-200 bg-white/70 p-6 text-slate-600 shadow-sm dark:border-white/10 dark:bg-white/5 dark:text-slate-300">
                        <p class="text-sm uppercase tracking-widest text-slate-500 dark:text-slate-400">Response time</p>
                        <h3 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">Under 24 hours</h3>
                        <p class="mt-3 text-sm">
                            We’re a small team, but we pride ourselves on replying fast. Expect a real answer, not a bot.
                        </p>
                        <div class="mt-6 rounded-2xl border border-dashed border-slate-200 p-4 text-center text-xs uppercase tracking-widest text-slate-500 dark:border-white/20 dark:text-slate-400">
                            Built with love, feedback, and many cups of coffee ☕
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('contact.send') }}"
                    class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg dark:border-white/10 dark:bg-white/5 space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Jane Doe"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30 dark:border-white/10 dark:bg-white/10 dark:text-white" />
                        @error('name')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30 dark:border-white/10 dark:bg-white/10 dark:text-white" />
                        @error('email')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Message</label>
                        <textarea name="message" rows="5" placeholder="Tell us about your hiring goals..."
                            class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 focus:border-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-400/30 dark:border-white/10 dark:bg-white/10 dark:text-white">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full rounded-2xl bg-emerald-500 px-6 py-3 text-sm font-semibold text-slate-950 transition hover:bg-emerald-400 focus:outline-none focus:ring-2 focus:ring-emerald-300 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-slate-900">
                        Send message
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
