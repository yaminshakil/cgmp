@php
    $configuredNavItems = section_data('navigation')['items'] ?? [];
    $navItems = count($configuredNavItems)
        ? collect($configuredNavItems)->map(fn ($item) => [$item['label'], $item['url']])->all()
        : [
            ['Home', route('home')],
            ['About', route('about')],
            ['Services', route('services.index')],
            ['Doctors', route('doctors')],
            ['Blog', route('blog.index')],
            ['Contact', route('contact')],
        ];
    // Menu links can be absolute or site-relative ("/about"), so compare paths rather than full URLs.
    $isCurrent = function (string $href): bool {
        $host = parse_url($href, PHP_URL_HOST);

        if ($host && $host !== request()->getHost()) {
            return false;
        }

        return rtrim(parse_url($href, PHP_URL_PATH) ?: '/', '/') === rtrim(request()->getPathInfo(), '/');
    };
    $bookIcon ='<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>';
@endphp

<div
    x-data="{
        open: false,
        scrolled: false,
        dark: document.documentElement.classList.contains('dark'),
        toggleTheme() {
            this.dark = !this.dark;
            document.documentElement.classList.toggle('dark', this.dark);
            try { localStorage.setItem('cgmp-theme', this.dark ? 'dark' : 'light'); } catch (e) {}
        }
    }"
    @scroll.window="scrolled = window.scrollY > 24"
>
    <header id="site-header" class="relative z-10 border-b border-gray-100 bg-white/95 backdrop-blur transition-colors duration-300 dark:border-white/10 dark:bg-[#1a1a1a]/95" :class="scrolled ? 'shadow-[0_6px_24px_rgba(15,42,67,0.16)] dark:shadow-[0_6px_24px_rgba(255,255,255,0.10)]' : 'shadow-[0_2px_16px_rgba(15,42,67,0.08)] dark:shadow-[0_2px_16px_rgba(255,255,255,0.07)]'">
        <div class="flex items-center justify-between gap-4 pl-4 pr-6 site-header__inner transition-[padding] duration-300" :class="scrolled ? 'py-2' : 'py-3'">
            <a
                href="{{ route('home') }}"
                @click="if (window.location.pathname === '{{ parse_url(route('home'), PHP_URL_PATH) ?: '/' }}') { $event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' }); }"
                class="origin-left shrink-0 rounded-xl transition-transform duration-300"
                :class="scrolled ? 'scale-90' : 'scale-100'"
            ><x-logo collapse-on-scroll /></a>

            <nav class="hidden items-center gap-1 lg:flex">
                @foreach($navItems as [$label, $href])
                    @php $isActive = $isCurrent($href); @endphp
                    <a href="{{ $href }}" class="nav-link relative rounded-lg px-3 py-2.5 text-[15px] font-medium tracking-wide transition-colors duration-200 xl:px-4 {{ $isActive ? 'bg-brand-blue-tint font-semibold text-brand-blue dark:bg-white/10 dark:text-[#e0e0e0]' : 'text-ink-soft hover:bg-gray-50 hover:text-brand-blue dark:text-white/70 dark:hover:bg-white/5 dark:hover:text-white' }}">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-3 lg:ml-0">
                <a href="tel:{{ preg_replace('/\s+/', '', setting('phone', '')) }}" class="hidden items-center gap-2 text-sm font-semibold text-ink-soft transition-colors hover:text-brand-blue dark:text-white/80 dark:hover:text-white xl:flex">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint text-brand-blue dark:bg-white/10 dark:text-[#e0e0e0]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    {{ setting('phone') }}
                </a>

                <div class="hidden h-6 w-px bg-gray-200 dark:bg-white/10 xl:block"></div>

                <button
                    type="button"
                    @click="toggleTheme()"
                    :aria-label="dark ? 'Switch to light mode' : 'Switch to dark mode'"
                    class="hidden h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-gray-200 text-gray-500 transition-colors hover:border-brand-red/30 hover:text-brand-red dark:border-white/10 dark:text-white/70 dark:hover:border-brand-red/40 dark:hover:text-white lg:flex"
                >
                    <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
                    <svg x-show="dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                </button>

                <x-healthengine-button :label="$bookIcon . 'Book Appointment'" class="bg-brand-red text-white hover:bg-brand-red-dark btn-lift hidden items-center gap-2 rounded-lg px-3 py-2.5 text-sm font-semibold shadow-sm hover:shadow-md xl:gap-3 xl:px-4 md:flex" />

                <button aria-label="Open menu" class="relative h-9 w-9 shrink-0 rounded-full transition-colors hover:bg-gray-100 dark:hover:bg-white/10 lg:hidden" @click="open = !open; $dispatch('mobile-nav', { open: open })">
                    <span class="absolute left-1/2 top-1/2 block h-0.5 w-5 -translate-x-1/2 rounded-full bg-ink transition-all duration-300 dark:bg-white" :class="open ? 'translate-y-0 rotate-45' : '-translate-y-[6px]'"></span>
                    <span class="absolute left-1/2 top-1/2 block h-0.5 w-5 -translate-x-1/2 rounded-full bg-ink transition-all duration-200 dark:bg-white" :class="open ? 'opacity-0' : 'opacity-100'"></span>
                    <span class="absolute left-1/2 top-1/2 block h-0.5 w-5 -translate-x-1/2 rounded-full bg-ink transition-all duration-300 dark:bg-white" :class="open ? 'translate-y-0 -rotate-45' : 'translate-y-[6px]'"></span>
                </button>
            </div>
        </div>

        <nav
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="flex flex-col gap-1 border-t bg-white px-6 py-4 dark:border-white/10 dark:bg-[#1a1a1a] lg:hidden"
        >
            @foreach($navItems as [$label, $href])
                <a href="{{ $href }}" class="rounded-lg border-l-4 px-3 py-2.5 text-sm font-medium tracking-wide transition-colors duration-200 hover:bg-brand-blue-tint dark:hover:bg-white/5 {{ $isCurrent($href) ? 'border-brand-blue bg-brand-blue-tint font-semibold text-brand-blue dark:border-white dark:bg-white/10 dark:text-[#e0e0e0]' : 'border-transparent text-ink-soft dark:text-white/70' }}">{{ $label }}</a>
            @endforeach
            <hr class="my-2 border-t border-gray-200 dark:border-white/10">
            <a href="tel:{{ preg_replace('/\s+/', '', setting('phone', '')) }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium tracking-wide text-ink-soft transition-colors duration-200 hover:bg-brand-blue-tint dark:text-white/70 dark:hover:bg-white/5">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint text-brand-blue dark:bg-white/10 dark:text-[#e0e0e0]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </span>
                {{ setting('phone') }}
            </a>
            <button
                type="button"
                @click="toggleTheme()"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium tracking-wide text-ink-soft transition-colors duration-200 hover:bg-brand-blue-tint dark:text-white/70 dark:hover:bg-white/5"
            >
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint text-brand-blue dark:bg-white/10 dark:text-[#e0e0e0]">
                    <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
                    <svg x-show="dark" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                </span>
                <span x-text="dark ? 'Light Mode' : 'Dark Mode'"></span>
            </button>
            <x-healthengine-button :label="$bookIcon . 'Book Appointment'" class="bg-brand-red text-white hover:bg-brand-red-dark btn-lift mt-2 flex items-center justify-center gap-3 rounded-lg px-5 py-4 font-semibold" />
            <a href="{{ route('emergency') }}" class="mt-2 flex items-center gap-2 px-3 py-2 text-sm font-semibold text-red-600">
                <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                Emergency Information
            </a>
        </nav>
    </header>
</div>
