@extends('layouts.public')

@section('title', 'About Us')

@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-brand-blue-darker via-brand-blue-dark to-brand-blue px-6 py-16 text-center">
    <span class="inline-flex items-center rounded-full border border-white/25 bg-white/10 px-4 py-1.5 text-[12.5px] font-semibold tracking-wide text-[#bcd4ea]">ABOUT OUR PRACTICE</span>
    <h1 style="{{ text_style($about['styles'] ?? null, 'heading') }}" class="mx-auto mt-4 max-w-3xl whitespace-nowrap font-serif text-[6vw] font-bold leading-tight text-white sm:whitespace-normal sm:text-3xl md:text-4xl">{{ $about['heading'] ?? 'Personalised Support for All Your Healthcare Needs' }}</h1>
    <p style="{{ text_style($about['styles'] ?? null, 'subheading') }}" class="mx-auto mt-3 max-w-xl text-base leading-relaxed text-[#aec4d8] md:text-lg">{{ $about['subheading'] ?? 'We are a passionate team of GPs dedicated to providing exceptional healthcare to our community.' }}</p>
</section>

{{-- Our Story --}}
<section class="px-6 py-24 md:py-28">
    <div class="mx-auto grid max-w-6xl items-center gap-16 md:grid-cols-2 md:gap-20">
        <div class="relative mb-10 md:mb-0" data-reveal>
            <img src="{{ image_url($about['image'] ?? null, 'images/hero-team.jpg') }}" alt="{{ setting('clinic_name') }}" class="h-[420px] w-full rounded-[18px] object-cover md:h-[500px]">

            @if(!empty($about['stats']))
                <div class="absolute inset-x-6 -bottom-8 flex divide-x divide-white/20 rounded-2xl bg-[#0f1c2a]/85 p-5 text-white shadow-xl backdrop-blur-sm">
                    @foreach($about['stats'] as $stat)
                        <div class="flex-1 px-2 text-center" data-reveal>
                            <p class="font-serif text-2xl font-bold md:text-[26px]">
                                <span data-count-to="{{ $stat['value'] }}" data-count-suffix="{{ $stat['suffix'] ?? '' }}">0{{ $stat['suffix'] ?? '' }}</span>
                            </p>
                            <p class="mt-1 text-[12.5px] text-[#c3d2df]">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div data-reveal>
            <span class="inline-flex items-center rounded-full bg-brand-blue-tint dark:bg-white/10 px-4 py-1.5 text-[12.5px] font-semibold tracking-wide text-[#062238] dark:text-[#e0e0e0]">OUR STORY</span>
            <h2 class="mt-6 font-serif text-3xl font-bold leading-tight text-[#062238] dark:text-[#e0e0e0] md:text-[38px]">A Practice Built on Trust &amp; Community</h2>
            <div style="{{ text_style($about['styles'] ?? null, 'body') }}" class="prose prose-p:mb-4 prose-p:leading-[1.75] prose-p:text-[#5c6b7a] dark:text-white/60 mt-6">{!! $about['body'] ?? '' !!}</div>

            @if(!empty($about['points']))
                <div class="mt-7 flex flex-col gap-3">
                    @foreach($about['points'] as $point)
                        <div class="flex items-center gap-2.5 text-[15px] font-medium text-[#14304a] dark:text-[#e0e0e0]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] shrink-0 text-brand-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="8 12 11 15 16 9"/></svg>
                            {{ $point }}
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-9 flex flex-wrap gap-4">
                <a href="{{ booking_url() }}" @if(booking_is_external()) target="_blank" rel="noopener" @endif class="btn-lift inline-flex items-center gap-2 rounded-[9px] bg-brand-red px-6 py-3.5 text-[15px] font-semibold text-white hover:bg-brand-red-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Book an Appointment
                </a>
                <a href="{{ route('doctors') }}" class="btn-lift inline-flex items-center gap-2 rounded-[9px] border-2 border-[#062238] px-6 py-3.5 text-[15px] font-semibold text-[#062238] hover:bg-[#062238] hover:text-white dark:border-white dark:text-[#e0e0e0] dark:hover:bg-white dark:hover:text-[#062238]">
                    Meet Our Team
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="bg-brand-blue-tint dark:bg-[#1a1a1a] px-6 py-24 text-center">
    <span class="inline-flex items-center rounded-full bg-white dark:bg-[#1a1a1a] px-4 py-1.5 text-[12.5px] font-semibold tracking-wide text-[#062238] dark:text-[#e0e0e0]">OUR VALUES</span>
    <h2 class="mx-auto mt-5 font-serif text-3xl font-bold text-[#062238] dark:text-[#e0e0e0] md:text-[42px]">What We Stand For</h2>
    <p class="mx-auto mt-4 max-w-xl text-base leading-relaxed text-[#5c6b7a] dark:text-white/60 md:text-[16.5px]">These core values guide every decision we make and every interaction we have with our patients.</p>

    <div class="reveal-stagger mx-auto mt-14 grid max-w-6xl gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl bg-white dark:bg-[#1a1a1a] p-9 text-left shadow-[0_6px_24px_rgba(20,48,74,0.06)]" data-reveal>
            <div class="mb-5 flex h-[54px] w-[54px] items-center justify-center rounded-xl bg-brand-blue-tint dark:bg-white/10 text-[#123b5c] dark:text-[#e0e0e0]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-[#062238] dark:text-[#e0e0e0]">Compassionate Care</h3>
            <p class="mt-2.5 text-sm leading-relaxed text-[#5c6b7a] dark:text-white/60">We treat every patient with compassion, dignity, and respect.</p>
        </div>
        <div class="rounded-2xl bg-white dark:bg-[#1a1a1a] p-9 text-left shadow-[0_6px_24px_rgba(20,48,74,0.06)]" data-reveal>
            <div class="mb-5 flex h-[54px] w-[54px] items-center justify-center rounded-xl bg-brand-blue-tint dark:bg-white/10 text-[#123b5c] dark:text-[#e0e0e0]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.5 13.5 17 22l-5-3-5 3 1.5-8.5"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-[#062238] dark:text-[#e0e0e0]">Clinical Excellence</h3>
            <p class="mt-2.5 text-sm leading-relaxed text-[#5c6b7a] dark:text-white/60">Our GPs are committed to evidence-based medicine and continuous professional development.</p>
        </div>
        <div class="rounded-2xl bg-white dark:bg-[#1a1a1a] p-9 text-left shadow-[0_6px_24px_rgba(20,48,74,0.06)]" data-reveal>
            <div class="mb-5 flex h-[54px] w-[54px] items-center justify-center rounded-xl bg-brand-blue-tint dark:bg-white/10 text-[#123b5c] dark:text-[#e0e0e0]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-[#062238] dark:text-[#e0e0e0]">Community Focus</h3>
            <p class="mt-2.5 text-sm leading-relaxed text-[#5c6b7a] dark:text-white/60">We are deeply rooted in our local community and proud to serve its diverse population.</p>
        </div>
        <div class="rounded-2xl bg-white dark:bg-[#1a1a1a] p-9 text-left shadow-[0_6px_24px_rgba(20,48,74,0.06)]" data-reveal>
            <div class="mb-5 flex h-[54px] w-[54px] items-center justify-center rounded-xl bg-brand-blue-tint dark:bg-white/10 text-[#123b5c] dark:text-[#e0e0e0]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <h3 class="font-serif text-lg font-bold text-[#062238] dark:text-[#e0e0e0]">Accessibility</h3>
            <p class="mt-2.5 text-sm leading-relaxed text-[#5c6b7a] dark:text-white/60">From flexible appointment times to bulk billing, we work hard to remove barriers to quality healthcare.</p>
        </div>
    </div>
</section>
@endsection
