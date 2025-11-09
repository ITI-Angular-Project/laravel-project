@if(auth()->check())
<div class="relative" 
     x-data="notificationDropdown({{ auth()->user()->unreadNotifications->count() > 0 ? 'true' : 'false' }})">

    {{-- Bell Icon --}}
    <button 
        @click="toggle"
        class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition"
    >
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke-width="1.8" 
             stroke="currentColor" 
             class="w-6 h-6 text-gray-600 dark:text-gray-300">
          <path stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M15 17h5l-1.405-1.405C18.21 15.21 18 14.702 18 14.17V11c0-2.21-1.79-4-4-4V6a2 2 0 10-4 0v1c-2.21 0-4 1.79-4 4v3.17c0 .532-.21 1.04-.595 1.425L4 17h5m6 0a3 3 0 01-6 0" />
        </svg>

        {{-- Red dot --}}
        <span 
            x-show="hasUnread"
            class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full"
        ></span>
    </button>

    {{-- Notifications Dropdown --}}
    <div 
        x-cloak 
        x-show="open"
        @click.outside="open = false"
        class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 z-50"
    >
        {{-- Title --}}
        <div class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-gray-900 rounded-t-xl">
            Notifications
        </div>

        {{-- Notification List --}}
        <div class="max-h-64 overflow-y-auto">
            @php
                $notifications = auth()->user()->notifications;
                $loginTime = session('login_time');
                if (!$loginTime) {
                    session(['login_time' => now()]);
                    $loginTime = now();
                }
                $recentNotifications = $notifications->filter(fn($n) => $n->created_at > $loginTime);
            @endphp

            @if($recentNotifications->count() > 0)
                @foreach($recentNotifications as $notification)
                    <div class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition border-t border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-700 dark:text-gray-200">
                            {{ $notification->data['message'] ?? 'New notification' }}
                        </p>
                    </div>
                @endforeach
            @else
                <div class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                    No new notifications
                </div>
            @endif
        </div>
    </div>
</div>
@endif

<script>
    function notificationDropdown(hasUnread) {
        return {
            open: false,
            hasUnread: hasUnread,
            marking: false,
            toggle() {
                this.open = !this.open;
                if (this.open) {
                    this.markRead();
                }
            },
            async markRead() {
                if (!this.hasUnread || this.marking) return;
                this.marking = true;
                try {
                    await fetch('{{ route('notifications.markAllRead') }}');
                    this.hasUnread = false;
                } catch (e) {
                    console.error(e);
                } finally {
                    this.marking = false;
                }
            },
        }
    }
</script>
