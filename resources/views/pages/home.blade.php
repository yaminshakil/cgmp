@extends('layouts.public')

@section('title', $hero['heading'] ?? 'Home')

@section('content')

<div class="h-1 bg-white dark:bg-[#1a1a1a] lg:hidden"></div>

@php
    $heroInfoLines = collect(preg_split('/\r\n|\r|\n/', trim(setting('opening_hours', ''))))
        ->map(fn ($line) => trim($line))
        ->filter()
        ->push(trim(setting('address_line1') . ', ' . setting('address_suburb'), ', '))
        ->filter()
        ->values();
    $heroBgColor = (string) ($hero['bg_color'] ?? '');
    $heroOnLight = false;
    if (preg_match('/^#([0-9a-fA-F]{6})$/', $heroBgColor, $bgColorMatch)) {
        $r = hexdec(substr($bgColorMatch[1], 0, 2));
        $g = hexdec(substr($bgColorMatch[1], 2, 2));
        $b = hexdec(substr($bgColorMatch[1], 4, 2));
        $heroOnLight = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255 > 0.7;
    }
    $heroTextClass       = $heroOnLight ? 'text-ink' : 'text-white';
    $heroMutedTextClass  = $heroOnLight ? 'text-ink-muted' : 'text-white/80';
    $heroBadgeTextClass  = $heroOnLight ? 'text-brand-blue' : 'text-white/90';
    $heroAccentClass     = $heroOnLight ? 'text-brand-red' : 'text-[#ffb4b4]';
    $heroSecondaryBtn    = $heroOnLight ? 'border-ink/15 bg-white/70 text-ink hover:bg-white' : 'border-white/30 hover:bg-white/10';
    $heroChipClass       = $heroOnLight ? 'border-ink/10 bg-white/70 text-ink' : 'border-white/15 bg-white/10 text-white/90';
    $heroEcgClass        = $heroOnLight ? 'text-brand-blue/30' : 'text-white/25';
    $heroMobileEcgClass  = $heroOnLight ? 'text-brand-blue/60' : 'text-white/45';
    $heroTextColorCss    = !empty($hero['text_color']) && preg_match('/^#[0-9a-fA-F]{6}$/', $hero['text_color']) ? 'color:' . $hero['text_color'] . ';' : '';

    $heroHeadingText = $hero['heading'] ?? 'Welcome to ' . setting('clinic_name');
    $heroHeadingWords = preg_split('/\s+/', trim($heroHeadingText));
    $heroHeadingHighlight = implode(' ', array_slice($heroHeadingWords, -2));
    $heroHeadingLeadWords = array_slice($heroHeadingWords, 0, -2);
    $heroPrimaryIsDefault = empty($hero['primary_button_link']) || $hero['primary_button_link'] === '/book-appointment';
    $heroPrimaryHref = $heroPrimaryIsDefault ? booking_url() : $hero['primary_button_link'];
    $heroPrimaryIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>';
    $heroPhone = trim((string) setting('phone', ''));
    $heroSecondaryLabel = $hero['secondary_button_text'] ?? '';
    $heroSecondaryHref = $hero['secondary_button_link'] ?? '';
    if ($heroSecondaryLabel === '') {
        $heroSecondaryLabel = 'Our Services';
        $heroSecondaryHref = $heroSecondaryHref ?: route('services.index');
    }

    $heroVideoUrl = $hero['video_url'] ?? null;
    $heroStatus = opening_hours_status();
    $heroVideoEmbed = null;
    $heroVideoDirect = null;
    if ($heroVideoUrl) {
        if (preg_match('~(?:youtube\.com/(?:watch\?v=|shorts/|embed/|live/)|youtu\.be/)([\w-]{6,})~i', $heroVideoUrl, $videoMatch)) {
            $heroVideoEmbed = 'https://www.youtube-nocookie.com/embed/' . $videoMatch[1] . '?rel=0';
        } elseif (preg_match('~vimeo\.com/(\d+)~i', $heroVideoUrl, $videoMatch)) {
            $heroVideoEmbed = 'https://player.vimeo.com/video/' . $videoMatch[1];
        } else {
            $heroVideoDirect = $heroVideoUrl;
        }
    }
@endphp
<section x-data="{ openVideo: false }" class="relative isolate overflow-hidden rounded-t-2xl {{ !empty($hero['bg_color']) ? '' : 'bg-gradient-to-br from-brand-blue-darker via-brand-blue to-brand-blue-vivid' }} text-white lg:rounded-none" @if(!empty($hero['bg_color'])) style="background-color: {{ $hero['bg_color'] }}" @endif>
    <div class="pointer-events-none absolute -left-20 -top-20 hidden h-[380px] w-[380px] rounded-full bg-brand-blue-vivid/30 blur-3xl lg:block" aria-hidden="true"></div>
    <div class="pointer-events-none absolute bottom-[-12%] right-[6%] hidden h-[320px] w-[320px] rounded-full bg-brand-red/25 blur-3xl lg:block" aria-hidden="true"></div>

    <svg class="hero-ecg pointer-events-none absolute inset-x-0 bottom-10 z-0 hidden h-16 w-full {{ $heroEcgClass }} lg:block xl:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" fill="none" aria-hidden="true">
        <g class="ecg-track-wide" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <path d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
            <path transform="translate(600)" d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
            <path transform="translate(1200)" d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
            <path transform="translate(1800)" d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
        </g>
    </svg>

    <div class="relative mx-auto flex flex-col lg:block lg:min-h-[660px]">
        <div class="relative z-10 order-2 -mt-8 px-6 pb-24 sm:px-8 lg:absolute lg:inset-y-0 lg:left-0 lg:order-1 lg:mt-0 lg:w-1/2 lg:px-16 lg:pb-12 lg:pt-[100px]">
            <div class="hero-copy relative w-full min-w-0 max-w-xl" style="container-type: inline-size">
                @if(!empty($hero['badge_text']))
                    <p style="--hero-delay: 60ms; font-size: clamp(1.3rem, 6cqw, 3.8rem); {{ $heroTextColorCss }}" class="hero-in hidden whitespace-nowrap font-bold uppercase leading-snug tracking-tight lg:block {{ $heroBadgeTextClass }}">
                        {{ $hero['badge_text'] }}
                    </p>
                @endif
                <h1 style="--hero-delay: 120ms; font-size: clamp(0.7rem, 3.3cqw, 1.45rem); font-family: 'Montserrat', 'Poppins', 'Century Gothic', ui-sans-serif, sans-serif; {{ $heroTextColorCss }}{{ text_style($hero['styles'] ?? null, 'heading') }}" class="hero-in mt-4 hidden whitespace-nowrap font-bold leading-[1.15] tracking-tight lg:block {{ $heroTextClass }} sm:mt-5">
                    @foreach($heroHeadingLeadWords as $wordIndex => $word)
                        <span class="hero-mask" style="--word-delay: {{ 180 + $wordIndex * 55 }}ms"><span class="hero-word">{{ $word }}</span></span>
                    @endforeach
                    <span class="hero-mask" style="--word-delay: {{ 180 + count($heroHeadingLeadWords) * 55 }}ms"><span class="hero-highlight font-bold italic {{ $heroAccentClass }}">{{ $heroHeadingHighlight }}</span></span>
                </h1>
                <p style="--hero-delay: 240ms; {{ $heroTextColorCss }}{{ text_style($hero['styles'] ?? null, 'subheading') }}" class="hero-in mt-1 max-w-md text-[15px] leading-relaxed {{ $heroMutedTextClass }} sm:mt-5 sm:text-base">{{ $hero['subheading'] ?? '' }}</p>
                <div style="--hero-delay: 360ms" class="hero-in mt-7 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    @if($heroPrimaryIsDefault)
                        <x-healthengine-button :label="$heroPrimaryIcon . e($hero['primary_button_text'] ?? 'Book Appointment')" class="bg-brand-red text-white hover:bg-brand-red-dark hero-cta btn-lift inline-flex items-center justify-center gap-3 rounded-xl px-8 py-4 text-base font-bold shadow-lg sm:text-lg" />
                    @else
                        <a href="{{ $heroPrimaryHref }}" class="hero-cta btn-lift inline-flex items-center justify-center gap-3 rounded-xl bg-brand-red px-8 py-4 text-base font-bold text-white shadow-lg hover:bg-brand-red-dark sm:text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            {{ $hero['primary_button_text'] ?? 'Book Appointment' }}
                        </a>
                    @endif
                    @if($heroPhone !== '')
                        <a href="tel:{{ preg_replace('/\s+/', '', $heroPhone) }}" class="btn-lift inline-flex items-center justify-center gap-3 rounded-xl border {{ $heroSecondaryBtn }} px-8 py-4 text-base font-semibold sm:text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            {{ $heroPhone }}
                        </a>
                    @elseif($heroSecondaryLabel)
                        <a href="{{ $heroSecondaryHref }}" class="btn-lift inline-flex items-center justify-center gap-3 rounded-xl border {{ $heroSecondaryBtn }} px-8 py-4 text-base font-semibold sm:text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-8.5 8.5 8.5 8.5 0 0 1-3.8-.9L3 21l1.9-5.7a8.5 8.5 0 0 1-.9-3.8 8.38 8.38 0 0 1 8.5-8.5 8.5 8.5 0 0 1 8.5 8.5Z"/></svg>
                            {{ $heroSecondaryLabel }}
                        </a>
                    @endif
                </div>
                @if($heroInfoLines->isNotEmpty())
<div style="--hero-delay: 480ms" class="hero-in mt-5 flex flex-wrap gap-2 text-xs sm:pr-24 sm:text-sm">
                    @if($heroStatus['is_open_day'])
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-600/30 bg-emerald-50 px-3.5 py-2 font-semibold text-emerald-700 shadow-sm backdrop-blur">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-500 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                            </span>
                            {{ $heroStatus['label'] }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full border {{ $heroChipClass }} px-3.5 py-2 font-semibold backdrop-blur">
                            <span class="flex h-2 w-2 shrink-0 rounded-full bg-brand-red"></span>
                            {{ $heroStatus['label'] }}
                        </span>
                    @endif
                    @foreach($heroInfoLines as $line)
                            <span class="hero-chip inline-flex items-center gap-1.5 rounded-full border {{ $heroChipClass }} px-3.5 py-2 backdrop-blur">
                                @if($loop->last)
                                    <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                @else
                                    <svg class="h-3.5 w-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                @endif
                                {{ $line }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="relative order-1 px-6 pb-24 pt-6 sm:px-8 lg:absolute lg:inset-y-0 lg:right-0 lg:order-2 lg:w-1/2 lg:px-10 lg:py-10 lg:pb-12">
            <div class="relative h-[300px] sm:h-[360px] lg:h-full">
                <div class="hero-photo absolute inset-0 overflow-hidden rounded-3xl shadow-2xl lg:rounded-[2rem]">
                    <img src="{{ image_url($hero['image'] ?? null, 'images/hero-clinic.jpg') }}" alt="Our clinic team" class="absolute inset-0 hidden h-full w-full object-cover lg:block">
                    <img src="{{ image_url($hero['mobile_image'] ?? $hero['image'] ?? null, 'images/hero-clinic.jpg') }}" alt="Our clinic team" class="absolute inset-0 block h-full w-full object-cover lg:hidden">
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/15 via-transparent to-transparent" aria-hidden="true"></div>
                    <div class="pointer-events-none absolute inset-0 z-10 flex flex-col justify-between px-3 py-4 sm:px-5 sm:py-5 lg:hidden">
                        @if(!empty($hero['badge_text']))
                            <div class="self-start rounded-2xl bg-gradient-to-r from-white/75 via-white/50 to-white/20 px-3 py-2 sm:px-4">
                                <p style="--hero-delay: 60ms; {{ $heroTextColorCss }}" class="hero-in text-left text-[clamp(1.15rem,5vw,1.65rem)] font-extrabold uppercase leading-snug tracking-tight drop-shadow-sm {{ $heroBadgeTextClass }}">{{ $hero['badge_text'] }}</p>
                            </div>
                        @endif
                        <div class="mt-auto w-[calc(100%_-_7.5rem)] self-start rounded-2xl bg-gradient-to-r from-white/95 via-white/85 to-white/70 px-3 py-2 shadow-lg backdrop-blur-sm sm:w-[calc(100%_-_12rem)] sm:px-4">
                            <h1 style="--hero-delay: 120ms; font-family: 'Montserrat', 'Poppins', 'Century Gothic', ui-sans-serif, sans-serif; {{ $heroTextColorCss }}" class="hero-in drop-shadow-sm mt-2 text-left font-bold leading-[1.3] tracking-normal {{ $heroTextClass }} text-[clamp(0.58rem,2.6vw,0.78rem)] [text-wrap:balance] sm:text-[clamp(0.68rem,2.4vw,0.95rem)]">
                                @foreach($heroHeadingLeadWords as $wordIndex => $word)
                                    <span class="hero-mask" style="--word-delay: {{ 180 + $wordIndex * 55 }}ms"><span class="hero-word">{{ $word }}</span></span>
                                @endforeach
                                <span class="hero-mask" style="--word-delay: {{ 180 + count($heroHeadingLeadWords) * 55 }}ms"><span class="hero-highlight font-bold italic {{ $heroAccentClass }}">{{ $heroHeadingHighlight }}</span></span>
                            </h1>
                        </div>
                    </div>
                </div>
                @if(file_exists(public_path('images/medicare-bulk-billing.png')))
                    <img src="{{ asset('images/medicare-bulk-billing.png') }}" alt="Medicare Bulk Billing Practice" loading="eager" class="hero-float absolute -bottom-6 -right-2 z-10 h-auto w-28 rounded-2xl shadow-xl sm:right-8 sm:w-36 lg:right-10 lg:w-[180px]">
                @endif
            </div>
            <svg class="hero-photo-ecg pointer-events-none absolute inset-x-6 bottom-8 h-8 w-[calc(100%-3rem)] {{ $heroMobileEcgClass }} lg:hidden" viewBox="0 0 600 60" preserveAspectRatio="none" fill="none" aria-hidden="true">
                <g class="hero-photo-ecg-track" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
                    <path transform="translate(600)" d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/>
                </g>
            </svg>
        </div>
    </div>

    @if($heroVideoUrl)
        <button type="button" x-on:click="openVideo = true" aria-label="Watch our clinic video" class="absolute bottom-6 right-6 z-20 flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-brand-blue-vivid to-brand-blue-dark text-white shadow-xl ring-4 ring-white/60 transition-transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.14v13.72a1 1 0 0 0 1.5.86l11-6.86a1 1 0 0 0 0-1.72l-11-6.86a1 1 0 0 0-1.5.86Z"/></svg>
        </button>

        <div x-show="openVideo" x-cloak x-transition.opacity.duration.200ms
             x-on:keydown.escape.window="openVideo = false"
             x-effect="document.documentElement.style.overflow = openVideo ? 'hidden' : ''"
             class="fixed inset-0 z-[110] flex items-center justify-center bg-black/75 p-4 sm:p-10"
             role="dialog" aria-modal="true" aria-label="Clinic video"
             x-on:click.self="openVideo = false">
            <div class="relative w-full max-w-4xl overflow-hidden rounded-2xl bg-black shadow-2xl">
                <button type="button" x-on:click="openVideo = false" aria-label="Close video" class="absolute right-3 top-3 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-white/15 text-white transition-colors hover:bg-white/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
                @if($heroVideoEmbed)
                    <iframe src="{{ $heroVideoEmbed }}" class="aspect-video w-full border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen title="Clinic introduction video"></iframe>
                @else
                    <video src="{{ $heroVideoDirect }}" controls autoplay playsinline class="aspect-video w-full bg-black"></video>
                @endif
            </div>
        </div>
    @endif
</section>

<section class="relative z-[1] border-b border-gray-100 dark:border-white/10 bg-white dark:bg-[#1a1a1a] px-6 py-6 shadow-[0_8px_24px_rgba(15,42,67,0.10)] dark:shadow-[0_8px_24px_rgba(255,255,255,0.07)]">
    <div class="mx-auto grid max-w-6xl grid-cols-2 gap-x-4 gap-y-5 sm:grid-cols-4 sm:gap-6">
        @foreach([
            ['M8 2v4M16 2v4M3 10h18M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z', 'Bulk Billing Available'],
            ['M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20ZM12 6v6l4 2', 'Same-Day Appointments'],
            ['M13 4h3a2 2 0 0 1 2 2v14M2 20h3M13 20h9M10 12v.01M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z', 'Walk-Ins Welcome'],
            ['M20 21a8 8 0 0 0-16 0M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z', 'Medicare &amp; Private Health'],
        ] as [$iconPath, $label])
            <div class="flex items-center gap-3">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $iconPath }}"/></svg>
                </span>
                <span class="text-xs font-semibold leading-snug text-ink dark:text-[#e0e0e0] sm:text-sm">{!! $label !!}</span>
            </div>
        @endforeach
    </div>
</section>

@if($services->isNotEmpty())
<section class="bg-white px-6 py-20 text-ink dark:bg-[#141414] dark:text-white md:py-28">
    <div class="mx-auto max-w-[1200px]">
        <p class="font-mono text-xs uppercase tracking-wider text-ink/55 dark:text-white/50">[Services]</p>
        <div class="mt-4 grid gap-6 md:grid-cols-[1.4fr_1fr] md:items-end md:gap-16">
            <h2 class="text-3xl font-light leading-[1.1] tracking-tight sm:text-4xl lg:text-5xl">Comprehensive care for your whole family</h2>
            <p class="max-w-sm text-sm leading-6 text-ink-muted dark:text-white/60 md:pb-1">From preventive care to specialist referrals, we provide a full spectrum of medical services tailored to our community.</p>
        </div>
        <x-services-grid :services="$services" class="mt-12" marquee />
        <div class="mt-10">
            <a href="{{ route('services.index') }}" class="btn-lift inline-flex items-center gap-2 rounded-xl border border-ink/25 px-6 py-3 text-sm font-semibold hover:bg-ink/5 dark:border-white/25 dark:hover:bg-white/10">
                View all services
                <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

@if($doctors->isNotEmpty())
<section class="bg-white dark:bg-[#1a1a1a] px-6 py-16">
    <x-section-title eyebrow="Meet Our Doctors" title="Expert Care from Experienced Practitioners" copy="Our team brings a wealth of experience and compassion to every consultation." :nowrap="true" copyClass="text-sm leading-6 sm:text-lg sm:leading-8" />
    <div class="reveal-stagger mx-auto mt-10 grid max-w-6xl gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach($doctors as $doctor)
            <x-doctor-card :doctor="$doctor" />
        @endforeach
    </div>
    <div class="mt-10 text-center">
        <a href="{{ route('doctors') }}" class="btn-lift inline-flex items-center gap-2 rounded-2xl bg-brand-red px-5 py-2.5 text-sm font-bold text-white shadow-lg hover:bg-brand-red-dark sm:px-7 sm:py-4 sm:text-base">
            Meet All Our Doctors
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
    </div>
</section>
@endif

@if($faqs->isNotEmpty())
<x-faq-section :faqs="$faqs" show-all-link />
@endif

<section class="bg-white dark:bg-[#1a1a1a] px-6 py-24">
    <x-section-title eyebrow="Get in Touch" title="Visit Us or Send a Message" copy="We're always happy to hear from you. Reach out with any questions or to find out more about our services." titleClass="text-[6vw] sm:whitespace-normal sm:text-3xl md:text-4xl lg:text-5xl" copyClass="text-sm leading-6 sm:text-lg sm:leading-8" />

    <div class="mx-auto mt-8 grid max-w-6xl gap-6 sm:mt-14 sm:gap-8 md:grid-cols-2">
        <div data-reveal>
            <div class="relative overflow-hidden rounded-3xl shadow-xl">
                <iframe
                    src="{{ setting('google_map_embed') ?: 'https://www.google.com/maps?q=' . urlencode(setting('address_suburb', 'Cringila NSW 2502, Australia')) . '&output=embed' }}"
                    class="h-[220px] w-full border-0 sm:h-[300px]"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Map showing {{ setting('clinic_name') }} location"
                ></iframe>
                <a
                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode(setting('address_suburb', 'Cringila NSW 2502')) }}"
                    target="_blank" rel="noopener"
                    class="btn-lift absolute left-3 top-3 inline-flex items-center gap-2 rounded-xl bg-white dark:bg-[#1a1a1a] px-3 py-1.5 text-xs font-semibold text-brand-blue shadow-md sm:left-4 sm:top-4 sm:px-4 sm:py-2 sm:text-sm"
                >
                    Open in Maps
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6M10 14 21 3"/></svg>
                </a>
            </div>

            <div class="mt-5 rounded-3xl bg-white dark:bg-[#232323] dark:border dark:border-white/10 p-4 shadow-xl dark:shadow-none sm:mt-6 sm:p-6">
                <div class="grid gap-4 sm:gap-5">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-ink-faint dark:text-white/60 sm:text-sm">Address</p>
                            <p class="text-sm font-medium text-ink dark:text-[#e0e0e0] sm:text-base">{{ setting('address_line1') }}, {{ setting('address_suburb') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-ink-faint dark:text-white/60 sm:text-sm">Phone</p>
                            <p class="text-sm font-medium text-ink dark:text-[#e0e0e0] sm:text-base">{{ setting('phone') }}</p>
                        </div>
                    </div>
                    @if(setting('fax'))
                        <div class="flex items-start gap-3 sm:gap-4">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9V2h12v7"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-ink-faint dark:text-white/60 sm:text-sm">Fax</p>
                                <p class="text-sm font-medium text-ink dark:text-[#e0e0e0] sm:text-base">{{ setting('fax') }}</p>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-ink-faint dark:text-white/60 sm:text-sm">Email</p>
                            <p class="break-all text-sm font-medium text-ink dark:text-[#e0e0e0] sm:text-base">{{ setting('contact_email') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-ink-faint dark:text-white/60 sm:text-sm">Opening Hours</p>
                            <p class="whitespace-pre-line text-sm font-medium text-ink dark:text-[#e0e0e0] sm:text-base">{{ setting('opening_hours') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white dark:bg-[#232323] dark:border dark:border-white/10 p-5 shadow-xl dark:shadow-none sm:p-8" data-reveal>
            <h2 class="font-serif text-xl font-bold sm:text-3xl">Send Us a Message</h2>

            @if(session('status'))
                <div class="mt-5 rounded-xl bg-emerald-50 p-4 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-300">{{ session('status') }}</div>
            @endif

            <form id="contact-form" method="POST" action="{{ route('contact.store') }}" class="mt-5 grid gap-4 sm:mt-7 sm:gap-5">
                @csrf
                <div class="grid gap-4 sm:gap-5 sm:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-semibold text-ink dark:text-[#e0e0e0] sm:text-base">Full Name *</span>
                        <input type="text" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white text-ink dark:border-white/10 dark:bg-white/5 dark:text-[#e0e0e0] dark:placeholder:text-white/30 p-3 focus:border-brand-blue focus:outline-none sm:p-4" placeholder="John Smith">
                        @error('name')<span class="mt-1 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                    </label>
                    <label class="block">
                        <span class="text-sm font-semibold text-ink dark:text-[#e0e0e0] sm:text-base">Email Address *</span>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-xl border border-slate-200 bg-white text-ink dark:border-white/10 dark:bg-white/5 dark:text-[#e0e0e0] dark:placeholder:text-white/30 p-3 focus:border-brand-blue focus:outline-none sm:p-4" placeholder="john@email.com">
                        @error('email')<span class="mt-1 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                    </label>
                </div>
                <label class="block">
                    <span class="text-sm font-semibold text-ink dark:text-[#e0e0e0] sm:text-base">Phone Number</span>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white text-ink dark:border-white/10 dark:bg-white/5 dark:text-[#e0e0e0] dark:placeholder:text-white/30 p-3 focus:border-brand-blue focus:outline-none sm:p-4" placeholder="0400 000 000">
                </label>
                <label class="block">
                    <span class="text-sm font-semibold text-ink dark:text-[#e0e0e0] sm:text-base">Message *</span>
                    <textarea name="message" required class="mt-2 min-h-28 w-full rounded-xl border border-slate-200 bg-white text-ink dark:border-white/10 dark:bg-white/5 dark:text-[#e0e0e0] dark:placeholder:text-white/30 p-3 focus:border-brand-blue focus:outline-none sm:min-h-32 sm:p-4" placeholder="How can we help you?">{{ old('message') }}</textarea>
                    @error('message')<span class="mt-1 block text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </label>

                <button type="submit" class="btn-lift flex w-full items-center justify-center gap-2 rounded-xl bg-brand-blue-darker px-6 py-3 text-sm font-bold text-white hover:bg-brand-blue-dark sm:py-4 sm:text-base">
                    Send Message
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>

@if($latestPosts->isNotEmpty())
<section class="relative isolate overflow-hidden bg-gradient-to-br from-white via-brand-blue-tint to-[#a9d4f5] px-6 py-14 dark:from-[#121212] dark:via-[#1a1a1a] dark:to-[#232323]">
    <span class="pointer-events-none absolute -left-6 -top-16 select-none font-serif text-[220px] leading-none text-brand-blue-tint dark:text-white/5 md:text-[280px]" aria-hidden="true">&ldquo;</span>
    <div class="relative">
        <x-section-title eyebrow="From the blog" title="Health Articles & Clinic News" copy="Read the latest updates and health advice from our practice." titleClass="whitespace-nowrap text-[5.5vw] sm:whitespace-normal sm:text-3xl md:text-4xl lg:text-5xl" copyClass="text-sm leading-6 sm:text-lg sm:leading-8" />
        <div class="mx-auto mt-6 h-px w-16 bg-brand-red"></div>
        <div class="reveal-stagger mx-auto mt-8 grid max-w-6xl gap-5 md:grid-cols-3">
            @foreach($latestPosts->take(3) as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 font-semibold text-brand-blue transition-transform duration-200 hover:translate-x-1">
                View All Posts
                <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

@include('partials.contact-form-script')
@endsection
