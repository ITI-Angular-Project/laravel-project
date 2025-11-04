import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        dark: false,
        hasStoredPreference: false,

        init() {
            const storedTheme = localStorage.getItem('theme');

            if (storedTheme === 'dark' || storedTheme === 'light') {
                this.hasStoredPreference = true;
                this.dark = storedTheme === 'dark';
            } else {
                this.dark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            }

            this.apply();
        },

        toggle() {
            this.hasStoredPreference = true;
            this.dark = !this.dark;
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            this.apply();
        },

        apply() {
            document.documentElement.classList.toggle('dark', this.dark);
            document.documentElement.style.colorScheme = this.dark ? 'dark' : 'light';
        },

        syncWithSystem(matches) {
            if (this.hasStoredPreference) {
                return;
            }

            this.dark = matches;
            this.apply();
        },
    });

    Alpine.store('theme').init();

    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    const syncSystemPreference = (event) => Alpine.store('theme').syncWithSystem(event.matches);

    if (typeof mediaQuery.addEventListener === 'function') {
        mediaQuery.addEventListener('change', syncSystemPreference);
    } else if (typeof mediaQuery.addListener === 'function') {
        mediaQuery.addListener(syncSystemPreference);
    }
});

Alpine.start();
