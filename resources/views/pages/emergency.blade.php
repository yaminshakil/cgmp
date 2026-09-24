@extends('layouts.public')

@section('title', 'Emergency & After-Hours Care')

@section('content')
<section class="bg-gradient-to-b from-red-800 to-red-900 px-6 py-14 text-center text-white sm:py-20">
    <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-wide">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
        Emergency Information
    </span>
    <h1 class="mt-5 whitespace-nowrap font-serif text-[9vw] font-bold sm:mt-6 sm:whitespace-normal sm:text-4xl md:text-5xl">In an Emergency?</h1>
    <p class="mx-auto mt-3 max-w-2xl text-sm text-red-50 sm:mt-4 sm:text-base">{{ setting('emergency_note', 'If you are experiencing a life-threatening emergency, call 000 immediately.') }}</p>
    <a href="tel:000" class="btn-lift emergency-pulse mt-6 inline-flex items-center gap-3 rounded-2xl bg-white dark:bg-[#1a1a1a] px-5 py-2.5 text-sm font-bold text-red-700 dark:text-red-400 shadow-lg hover:bg-red-50 dark:hover:bg-[#232323] sm:mt-8 sm:px-7 sm:py-4 sm:text-base">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call 000 Now
    </a>
</section>

<section class="px-6 py-10 sm:py-16">
    <div data-reveal class="mx-auto max-w-4xl overflow-hidden rounded-2xl border border-[#e7edf3] dark:border-white/10 shadow-sm">
        <div class="flex items-center gap-3 bg-red-600 px-4 py-3 text-white sm:px-6 sm:py-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <h2 class="font-serif text-base font-bold sm:text-lg">Emergency Numbers</h2>
        </div>
        <div class="reveal-stagger grid gap-3 p-4 sm:grid-cols-2 sm:gap-4 sm:p-6">
            @foreach([
                ['Emergency Services (Police/Ambulance/Fire)', '000', 'border-red-100 bg-red-50 text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-300'],
                ['After-Hours GP (13 SICK)', '13 7425', 'border-amber-100 bg-amber-50 text-amber-700 dark:border-amber-500/20 dark:bg-amber-500/10 dark:text-amber-300'],
                ['Poisons Information Centre', '13 11 26', 'border-purple-100 bg-purple-50 text-purple-700 dark:border-purple-500/20 dark:bg-purple-500/10 dark:text-purple-300'],
                ['Mental Health Crisis Line', '1800 011 511', 'border-blue-100 bg-blue-50 text-blue-700 dark:border-blue-500/20 dark:bg-blue-500/10 dark:text-blue-300'],
                ['Lifeline (24/7 crisis support)', '13 11 14', 'border-green-100 bg-green-50 text-green-700 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-300'],
            ] as [$label, $number, $classes])
                <div data-reveal class="flex flex-wrap items-center justify-between gap-x-3 gap-y-1 rounded-xl border px-3 py-2.5 sm:px-4 sm:py-3 {{ $classes }}">
                    <span class="text-xs font-medium sm:text-sm">{{ $label }}</span>
                    <span class="text-sm font-bold sm:text-base">{{ $number }}</span>
                </div>
            @endforeach
            <div class="flex flex-wrap items-center justify-between gap-x-3 gap-y-1 rounded-xl border border-brand-blue-tint bg-brand-blue-tint dark:bg-white/10 px-3 py-2.5 text-brand-blue sm:px-4 sm:py-3">
                <span class="text-xs font-medium sm:text-sm">Our Practice</span>
                <a href="tel:{{ preg_replace('/\s+/', '', setting('phone', '')) }}" class="text-sm font-bold hover:underline sm:text-base">{{ setting('phone') }}</a>
            </div>
        </div>
    </div>

    <div data-reveal class="mx-auto mt-6 max-w-4xl rounded-2xl border border-[#e7edf3] dark:border-white/10 p-4 shadow-sm sm:mt-8 sm:p-8">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <h2 class="font-serif text-base font-bold text-ink dark:text-[#e0e0e0] sm:text-lg">After-Hours Care</h2>
        </div>
        <p class="mt-2 text-sm text-ink-muted dark:text-white/60 sm:mt-3 sm:text-base">When our clinic is closed and you need medical attention that is not life-threatening, you have several options:</p>
        <div class="reveal-stagger mt-4 grid gap-2.5 sm:mt-5 sm:gap-3">
            @foreach([
                ['13 SICK (National Home Doctor Service)', 'Call 13 7425 for a GP to visit your home after hours. Available nights, weekends, and public holidays.'],
                ['Urgent Care Centres', 'For non-life-threatening conditions requiring prompt attention, your nearest urgent care centre can help.'],
                ['Hospital Emergency Departments', 'For serious conditions requiring immediate hospital care, go to your nearest hospital emergency department.'],
                ['Telehealth Services', 'Some telehealth services are available after hours. Call HealthDirect on 1800 022 222 for guidance.'],
            ] as [$title, $body])
                <div data-reveal class="flex items-start gap-3 rounded-xl bg-brand-red-tint dark:bg-brand-red/15 px-3 py-2.5 sm:px-4 sm:py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-brand-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m22 4-10 10-3-3"/></svg>
                    <span>
                        <span class="block text-sm font-bold text-ink dark:text-[#e0e0e0] sm:text-base">{{ $title }}</span>
                        <span class="text-xs text-ink-muted dark:text-white/60 sm:text-sm">{{ $body }}</span>
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <div data-reveal class="mx-auto mt-6 max-w-4xl rounded-2xl border border-[#e7edf3] dark:border-white/10 p-4 shadow-sm sm:mt-8 sm:p-8">
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-red" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
            <h2 class="font-serif text-base font-bold text-ink dark:text-[#e0e0e0] sm:text-lg">Nearest Hospitals</h2>
        </div>
        <div class="reveal-stagger mt-4 grid gap-2.5 sm:mt-5 sm:gap-3">
            @forelse($hospitals as $hospital)
                <div class="rounded-xl bg-brand-red-tint dark:bg-brand-red/15 px-3 py-2.5 sm:px-4 sm:py-3">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sm font-bold text-ink dark:text-[#e0e0e0] sm:text-base">{{ $hospital['name'] }}</span>
                        @if(!empty($hospital['distance']))
                            <span class="shrink-0 rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700 dark:bg-purple-500/10 dark:text-purple-300">~{{ $hospital['distance'] }}</span>
                        @endif
                    </div>
                    @if(!empty($hospital['address']))
                        <p class="mt-1 text-xs text-ink-muted dark:text-white/60 sm:text-sm">{{ $hospital['address'] }}</p>
                    @endif
                    @if(!empty($hospital['phone']))
                        <a href="tel:{{ preg_replace('/\s+/', '', $hospital['phone']) }}" class="mt-1 block text-xs font-semibold text-brand-blue hover:underline sm:text-sm">{{ $hospital['phone'] }}</a>
                    @endif
                </div>
            @empty
                <p class="text-sm text-ink-muted dark:text-white/60">Hospital details haven't been added yet &mdash; add your nearest hospitals from Admin &rarr; Sections.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
