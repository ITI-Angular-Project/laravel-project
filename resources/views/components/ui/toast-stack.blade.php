<div x-cloak x-show="toasts.length"
    class="pointer-events-none fixed top-4 right-4 z-[120] flex w-full max-w-sm flex-col gap-3" aria-live="assertive"
    aria-atomic="true">
    <template x-for="toast in toasts" :key="toast.id">
        <div x-transition:enter="transform ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transform ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
            class="pointer-events-auto overflow-hidden rounded-2xl border bg-white/95 p-4 shadow-xl backdrop-blur-md dark:bg-gray-900/90"
            :class="toastStyles(toast.type)" role="status">
            <div class="flex items-start gap-3">
                <div class="mt-0.5" x-html="toastIcon(toast.type)" aria-hidden="true"></div>
                <div class="flex-1 text-sm leading-relaxed text-gray-800 dark:text-gray-100" x-text="toast.message"></div>
                <button type="button"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-xl border border-transparent text-gray-400 transition hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-500/40 dark:text-gray-500 dark:hover:text-gray-300"
                    @click="dismissToast(toast.id)" :aria-label="`Dismiss ${toast.type ?? 'notification'}`">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
