@props(['doctor'])

<div data-reveal class="group flex flex-col overflow-hidden rounded-[22px] bg-white shadow-[0_10px_30px_rgba(0,80,150,0.12)] transition-all duration-300 ease-out hover:-translate-y-1.5 hover:shadow-[0_20px_48px_rgba(0,80,150,0.2)] dark:border dark:border-white/10 dark:bg-[#1c1c1c] dark:shadow-none">
    <div class="relative aspect-[4/5] w-full overflow-hidden bg-gradient-to-br from-brand-blue-vivid to-brand-blue-dark">
        @if($doctor->photo)
            <img src="{{ image_url($doctor->photo) }}" alt="{{ $doctor->name }}" loading="lazy" class="h-full w-full object-cover object-top transition-transform duration-700 ease-out group-hover:scale-105">
        @else
            <div class="flex h-full w-full items-center justify-center font-serif text-5xl font-bold text-white/90">
                {{ collect(explode(' ', $doctor->name))->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
            </div>
        @endif
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6">
            <h3 style="{{ text_style($doctor->text_styles, 'name') }}" class="font-serif text-xl font-bold leading-tight text-white drop-shadow-sm sm:text-2xl">{{ $doctor->name }}</h3>
            <p style="{{ text_style($doctor->text_styles, 'role') }}" class="mt-1 text-[13px] font-medium text-white/85 sm:text-sm">{{ $doctor->role }}</p>
        </div>
    </div>

    <div class="flex flex-1 flex-col p-5 sm:p-6">
        @if($doctor->qualifications)
            <p style="{{ text_style($doctor->text_styles, 'qualifications') }}" class="text-[11px] font-bold uppercase tracking-[0.14em] text-brand-blue dark:text-[#7fc2e8]">{{ $doctor->qualifications }}</p>
        @endif

        @if($doctor->bio)
            <p style="{{ text_style($doctor->text_styles, 'bio') }}" class="{{ $doctor->qualifications ? 'mt-2.5' : '' }} line-clamp-2 text-sm leading-relaxed text-gray-500 dark:text-white/70">{{ $doctor->bio }}</p>
        @endif

        @php
            $dayMap = ['sun' => 'Sun', 'mon' => 'Mon', 'tue' => 'Tue', 'wed' => 'Wed', 'thu' => 'Thu', 'fri' => 'Fri', 'sat' => 'Sat'];
            $activeDays = $doctor->availability_days ?? [];
            $dayLabels = collect($activeDays)->map(fn ($d) => $dayMap[$d] ?? ucfirst($d));
        @endphp

        @if($dayLabels->isNotEmpty() || $doctor->languageList())
            <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-2">
                @if($dayLabels->isNotEmpty())
                    <span class="inline-flex items-center text-xs font-medium text-gray-500 dark:text-white/60">
                        <svg class="mr-1.5 h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        @if($dayMap && $activeDays) {{ $dayLabels->implode(' · ') }} @endif
                    </span>
                @endif
                @foreach($doctor->languageList() as $language)
                    <span class="inline-flex items-center rounded-full bg-brand-blue-tint px-2.5 py-0.5 text-[11px] font-semibold text-brand-blue dark:bg-white/10 dark:text-white/80">{{ $language }}</span>
                @endforeach
            </div>
        @endif

        <div class="mt-auto pt-5">
            <a href="{{ booking_url() }}" data-book-appointment @if($doctor->healthengine_doctor_id) data-doctor-id="{{ $doctor->healthengine_doctor_id }}" @endif @if(booking_is_external() && ! setting('healthengine_id')) target="_blank" rel="noopener" @endif class="btn-lift flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-6 py-2.5 text-xs font-semibold text-white shadow-lg transition-colors duration-200 hover:bg-brand-red-dark sm:py-3 sm:text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                Book Appointment
            </a>
            <a href="{{ route('doctors.show', $doctor) }}" class="mt-2 block py-1 text-center text-xs font-medium text-brand-blue transition-colors duration-200 hover:text-brand-red sm:text-sm">
                View Full Profile &rarr;
            </a>
        </div>
    </div>
</div>