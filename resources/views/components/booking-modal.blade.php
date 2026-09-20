@if(setting('healthengine_id'))
<div
    x-data="{ open: false, loaded: false, src: 'https://healthengine.com.au/webplugin/?id={{ e(setting('healthengine_id')) }}&source=webplugin&trigger=button' }"
    x-on:open-booking.window="open = true; loaded = true"
    x-on:keydown.escape.window="open = false"
    x-effect="document.documentElement.style.overflow = open ? 'hidden' : ''"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.200ms
    class="fixed inset-0 z-[100] flex items-stretch justify-center bg-black/60 sm:items-center sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-label="Book an appointment"
    @click.self="open = false"
>
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-y-6 scale-95 opacity-0"
        x-transition:enter-end="translate-y-0 scale-100 opacity-100"
        class="relative flex h-full w-full flex-col overflow-hidden bg-white shadow-2xl dark:bg-[#1a1a1a] sm:h-[min(760px,92vh)] sm:max-w-3xl sm:rounded-2xl"
    >
        <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3 dark:border-white/10">
            <span class="font-serif text-base font-bold text-[#062238] dark:text-[#e0e0e0]">Book an Appointment</span>
            <button type="button" @click="open = false" aria-label="Close booking" class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100 dark:text-white/70 dark:hover:bg-white/10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="relative flex-1 bg-white">
            <div class="absolute inset-0 flex items-center justify-center text-sm text-gray-400">Loading booking&hellip;</div>
            <template x-if="loaded">
                <iframe :src="src" title="HealthEngine booking" class="relative h-full w-full border-0" allow="payment"></iframe>
            </template>
        </div>
    </div>
</div>
@endif
