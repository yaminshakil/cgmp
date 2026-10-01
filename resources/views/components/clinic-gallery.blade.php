@props(['bg' => 'bg-white dark:bg-[#141414]', 'compact' => false])

@php
    $photos = collect(clinic_gallery_items())
        ->filter(fn ($p) => ! empty($p['image']))
        ->map(fn ($p) => [
            'src' => image_url($p['image']),
            'alt' => $p['alt'] ?: ($p['caption'] ?? ''),
            'caption' => $p['caption'] ?? '',
            'sub' => $p['sub'] ?? '',
        ])
        ->values()
        ->all();
@endphp

@if(count($photos))
<section class="{{ $bg }} px-6 {{ $compact ? 'py-16' : 'py-20 md:py-24' }}" x-data="{ open: null, photos: @js($photos) }" @keydown.escape.window="open = null" @keydown.arrow-right.window="if (open !== null) open = (open + 1) % photos.length" @keydown.arrow-left.window="if (open !== null) open = (open - 1 + photos.length) % photos.length">
    <x-section-title eyebrow="Our Clinic" title="Take a Look Inside" :copy="$compact ? null : 'See what to expect when you visit us at 23 Lake Avenue, Cringila.'" titleClass="text-3xl md:text-5xl" copyClass="text-base leading-7 md:text-lg" />

    <div class="mx-auto {{ $compact ? 'mt-10' : 'mt-12' }} grid max-w-6xl gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($photos as $i => $photo)
            <figure data-reveal class="group overflow-hidden rounded-2xl bg-white shadow-lg dark:bg-[#1f1f1f]">
                <button type="button" @click="open = {{ $i }}" class="relative block aspect-[4/3] w-full overflow-hidden" aria-label="Enlarge photo: {{ $photo['caption'] }}">
                    <img src="{{ $photo['src'] }}" alt="{{ $photo['alt'] }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <span class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-black/45 text-white opacity-0 transition group-hover:opacity-100" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                    </span>
                </button>
                <figcaption class="px-5 py-4">
                    <p class="font-semibold text-ink dark:text-[#e0e0e0]">{{ $photo['caption'] }}</p>
                    @unless($compact)<p class="mt-1 text-sm text-ink-muted dark:text-white/60">{{ $photo['sub'] }}</p>@endunless
                </figcaption>
            </figure>
        @endforeach
    </div>

    @if($compact)
        <div class="mt-10 text-center">
            <a href="{{ route('contact') }}" class="btn-lift inline-flex items-center gap-2 rounded-2xl border-2 border-brand-blue px-6 py-3 text-sm font-bold text-brand-blue hover:bg-brand-blue hover:text-white dark:border-white/40 dark:text-white sm:text-base">
                Get Directions
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
        </div>
    @endif

    {{-- Lightbox --}}
    <div x-show="open !== null" x-cloak x-transition.opacity class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4" role="dialog" aria-modal="true" aria-label="Clinic photo viewer" @click.self="open = null">
        <button type="button" @click="open = null" class="absolute right-4 top-4 flex h-11 w-11 items-center justify-center rounded-full bg-white/15 text-white hover:bg-white/25" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
        <button type="button" @click="open = (open - 1 + photos.length) % photos.length" class="absolute left-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/15 text-white hover:bg-white/25" aria-label="Previous photo">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </button>
        <button type="button" @click="open = (open + 1) % photos.length" class="absolute right-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white/15 text-white hover:bg-white/25" aria-label="Next photo">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </button>
        <figure class="max-h-full max-w-5xl">
            <img :src="open !== null ? photos[open].src : ''" :alt="open !== null ? photos[open].alt : ''" class="max-h-[80vh] w-auto rounded-xl object-contain">
            <figcaption class="mt-3 text-center text-sm text-white/85" x-text="open !== null ? photos[open].caption : ''"></figcaption>
        </figure>
    </div>
</section>
@endif
