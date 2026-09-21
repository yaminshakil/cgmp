@extends('layouts.public')

@section('title', $doctor->name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($doctor->bio ?: $doctor->role . ' at ' . setting('clinic_name')), 155))

@php
    $activeDays = $doctor->availability_days ?? [];
    $allDays = ['sun' => 'Sun', 'mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat'];
    $initials = collect(explode(' ', $doctor->name))->map(fn ($w) => mb_substr($w, 0, 1))->implode('');
    $bookAttrs = ($doctor->healthengine_doctor_id ? 'data-doctor-id="' . $doctor->healthengine_doctor_id . '" ' : '')
        . (booking_is_external() && ! setting('healthengine_id') ? 'target="_blank" rel="noopener"' : '');
    $address = trim(setting('address_line1') . ', ' . setting('address_suburb'), ', ');
@endphp

@section('content')
<section class="bg-white px-6 pb-20 pt-10 dark:bg-[#1a1a1a] md:pt-14">
    <div class="mx-auto max-w-[1180px]">
        <a href="{{ route('doctors') }}" class="text-sm font-medium text-brand-blue hover:text-brand-red">&larr; All doctors</a>

        <div class="mt-8 grid gap-10 lg:grid-cols-[280px_minmax(0,1fr)_320px] lg:gap-12">
            {{-- Portrait + contact --}}
            <aside data-reveal="left">
                <div class="aspect-[4/5] overflow-hidden rounded-[28px] bg-[#e9e6df] dark:bg-white/10">
                    @if($doctor->photo)
                        <img src="{{ image_url($doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover object-top">
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-brand-blue-vivid to-brand-blue-dark text-6xl font-bold text-white">{{ $initials }}</div>
                    @endif
                </div>

                <ul class="mt-6 space-y-3 text-sm text-[#45627d] dark:text-white/70">
                    @if($address !== '')
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ $address }}<br><span class="text-[#6b8199] dark:text-white/50">{{ setting('clinic_name') }}</span></span>
                        </li>
                    @endif
                    @if(setting('phone'))
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', setting('phone')) }}" class="hover:text-brand-red">{{ setting('phone') }}</a>
                        </li>
                    @endif
                    @if(setting('contact_email'))
                        <li class="flex gap-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-brand-blue" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/></svg>
                            <a href="mailto:{{ setting('contact_email') }}" class="break-all hover:text-brand-red">{{ setting('contact_email') }}</a>
                        </li>
                    @endif
                </ul>

                @if($doctor->languageList())
                    <ul class="mt-6 list-disc space-y-1 pl-5 text-sm text-[#45627d] marker:text-brand-blue dark:text-white/70">
                        @foreach($doctor->languageList() as $language)
                            <li>{{ $language }}</li>
                        @endforeach
                    </ul>
                @endif
            </aside>

            {{-- Name, summary, availability --}}
            <div data-reveal>
                <h1 style="{{ text_style($doctor->text_styles, 'name') }}" class="font-serif text-4xl font-extrabold leading-tight tracking-tight text-[#062238] dark:text-[#e0e0e0] md:text-5xl">{{ $doctor->name }}</h1>
                @if($doctor->qualifications || $doctor->role)
                    <p class="mt-3 text-[11px] font-semibold uppercase tracking-[0.16em] text-brand-blue">
                        {{ collect([$doctor->role, $doctor->qualifications])->filter()->implode(' · ') }}
                    </p>
                @endif

                @if($doctor->years_experience || $doctor->bio)
                    <div class="mt-8 flex flex-col overflow-hidden rounded-[24px] bg-[#f4f6f8] dark:bg-white/5 sm:flex-row">
                        @if($doctor->years_experience)
                            <div class="flex shrink-0 flex-col items-center justify-center bg-brand-blue px-8 py-8 text-center text-white sm:w-44">
                                <span class="font-serif text-4xl font-extrabold leading-none">{{ $doctor->years_experience }}</span>
                                <span class="mt-2 text-xs font-semibold uppercase tracking-wider text-white/80">Experience</span>
                            </div>
                        @endif
                        @if($doctor->bio)
                            <div class="p-6 sm:p-7">
                                <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#6b8199] dark:text-white/50">About</p>
                                <p style="{{ text_style($doctor->text_styles, 'bio') }}" class="mt-2 text-[15px] leading-7 text-[#45627d] dark:text-white/75">{{ $doctor->bio }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                @if(count($activeDays))
                <h2 class="mt-10 font-serif text-xl font-bold text-[#062238] dark:text-[#e0e0e0]">Consulting days</h2>
                <div class="mt-4 grid grid-cols-7 gap-2 sm:gap-3">
                    @foreach($allDays as $value => $label)
                        @php $on = in_array($value, $activeDays); @endphp
                        <div class="rounded-2xl px-1 py-4 text-center {{ $on ? 'bg-[#062238] text-white dark:bg-brand-blue' : 'bg-[#f4f6f8] text-[#9aabbd] dark:bg-white/5 dark:text-white/30' }}">
                            <p class="text-[10px] font-bold uppercase tracking-wider sm:text-xs">{{ $label }}</p>
                            <p class="mt-1 text-[10px] {{ $on ? 'text-white/70' : '' }}">{{ $on ? 'In' : 'Off' }}</p>
                        </div>
                    @endforeach
                </div>
                @endif

            </div>

            {{-- Booking card --}}
            <aside data-reveal="right">
                <div class="rounded-[24px] bg-[#f4f6f8] p-6 dark:bg-white/5 lg:sticky lg:top-28">
                    <h2 class="font-serif text-xl font-bold text-[#062238] dark:text-[#e0e0e0]">Book an Appointment</h2>
                    <p class="mt-1 text-sm text-[#6b8199] dark:text-white/50">with {{ $doctor->name }}</p>

                    @if(count($activeDays))
                    <p class="mt-6 text-[10px] font-bold uppercase tracking-[0.18em] text-[#6b8199] dark:text-white/50">Available days</p>
                    <div class="mt-3 grid grid-cols-7 gap-1.5">
                        @foreach($allDays as $value => $label)
                            @php $on = in_array($value, $activeDays); @endphp
                            <span title="{{ $label }}" class="flex aspect-square items-center justify-center rounded-xl text-xs font-bold {{ $on ? 'bg-[#062238] text-white dark:bg-brand-blue' : 'bg-white text-[#b3c0cf] dark:bg-white/10 dark:text-white/30' }}">{{ mb_substr($label, 0, 1) }}</span>
                        @endforeach
                    </div>
                    @endif

                    @if(setting('opening_hours'))
                        <p class="mt-6 text-[10px] font-bold uppercase tracking-[0.18em] text-[#6b8199] dark:text-white/50">Clinic hours</p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-[#45627d] dark:text-white/70">{{ setting('opening_hours') }}</p>
                    @endif

                    <a href="{{ booking_url() }}" data-book-appointment {!! $bookAttrs !!} class="btn-lift mt-7 flex w-full items-center justify-center gap-2 rounded-2xl bg-brand-red px-6 py-4 text-sm font-bold text-white shadow-lg hover:bg-brand-red-dark">
                        Book Now
                    </a>
                    @if(setting('phone'))
                        <p class="mt-4 text-center text-xs text-[#6b8199] dark:text-white/50">or call <a href="tel:{{ preg_replace('/\s+/', '', setting('phone')) }}" class="font-semibold text-brand-blue hover:text-brand-red">{{ setting('phone') }}</a></p>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
