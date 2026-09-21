@props(['doctor'])

<div class="doctor-card flex flex-col rounded-[22px] bg-white dark:bg-[#232323] dark:border dark:border-white/10 p-5 transition-all duration-300 ease-out hover:-translate-y-1 sm:p-7" data-reveal>
    <div class="mb-4 flex flex-col items-center text-center sm:mb-5">
        <div class="relative h-28 w-28 shrink-0 sm:h-36 sm:w-36">
            <div class="avatar-ring absolute -inset-[3px] rounded-full"></div>
            <div class="avatar-glow relative flex h-28 w-28 items-center justify-center overflow-hidden rounded-full bg-gradient-to-br from-brand-blue-vivid to-brand-blue-dark text-xl font-bold text-white sm:h-36 sm:w-36 sm:text-3xl">
                @if($doctor->photo)
                    <img src="{{ image_url($doctor->photo) }}" alt="{{ $doctor->name }}" class="h-full w-full object-cover object-top">
                @else
                    {{ collect(explode(' ', $doctor->name))->map(fn ($w) => mb_substr($w, 0, 1))->implode('') }}
                @endif
            </div>
        </div>
        <h3 style="{{ text_style($doctor->text_styles, 'name') }}" class="mt-3 text-base font-bold text-[#002B49] dark:text-[#e0e0e0] sm:mt-4 sm:text-lg">{{ $doctor->name }}</h3>
        <p style="{{ text_style($doctor->text_styles, 'qualifications') }}" class="mt-1 text-xs font-semibold text-brand-blue sm:text-[13px]">{{ $doctor->qualifications }}</p>
        <p style="{{ text_style($doctor->text_styles, 'role') }}" class="text-xs text-gray-500 dark:text-white/80 sm:text-[13px]">{{ $doctor->role }}</p>
    </div>

    @if($doctor->bio)
        <p style="{{ text_style($doctor->text_styles, 'bio') }}" class="mb-3 line-clamp-2 text-xs leading-relaxed text-gray-500 dark:text-white/75 sm:mb-4 sm:text-sm">{{ $doctor->bio }}</p>
    @endif

    @if($doctor->years_experience || $doctor->languageList())
        <div class="mb-3 flex flex-wrap justify-center gap-1.5 sm:mb-4 sm:gap-2">
            @if($doctor->years_experience)
                <span class="inline-flex items-center rounded-full bg-gray-100 dark:bg-white/10 px-2.5 py-0.5 text-[11px] font-medium text-gray-600 dark:text-white/80 sm:px-3 sm:py-1 sm:text-xs">{{ $doctor->years_experience }}</span>
            @endif
            @foreach($doctor->languageList() as $language)
                <span class="inline-flex items-center gap-1 rounded-full bg-brand-blue-tint dark:bg-white/10 px-2.5 py-0.5 text-[11px] font-medium text-brand-blue sm:px-3 sm:py-1 sm:text-xs">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/></svg>
                    {{ $language }}
                </span>
            @endforeach
        </div>
    @endif

    <div class="mb-3 sm:mb-4">
        <div class="flex justify-center gap-1 sm:gap-1.5">
            @php $activeDays = $doctor->availability_days ?? []; @endphp
            @foreach(['sun' => 'S', 'mon' => 'M', 'tue' => 'T', 'wed' => 'W', 'thu' => 'T', 'fri' => 'F'] as $value => $label)
                <span
                    class="flex h-7 w-7 items-center justify-center rounded-lg text-[11px] font-bold sm:h-8 sm:w-8 sm:text-xs {{ in_array($value, $activeDays) ? 'bg-brand-red text-white' : 'bg-gray-100 dark:bg-white/10 text-gray-300 dark:text-white/45' }}"
                    title="{{ ucfirst($value) }}"
                >{{ $label }}</span>
            @endforeach
        </div>
    </div>

    <div class="mt-auto">
        <a href="{{ booking_url() }}" data-book-appointment @if($doctor->healthengine_doctor_id) data-doctor-id="{{ $doctor->healthengine_doctor_id }}" @endif @if(booking_is_external() && ! setting('healthengine_id')) target="_blank" rel="noopener" @endif class="btn-book btn-lift flex w-full items-center justify-center gap-2 rounded-xl px-6 py-2 text-xs font-semibold shadow-lg sm:px-8 sm:py-2.5 sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            Book Appointment
        </a>
        <a href="{{ route('doctors.show', $doctor) }}" class="mt-1.5 block py-1.5 text-center text-xs font-medium text-brand-blue transition-colors duration-200 hover:text-brand-red sm:text-sm">
            View Full Profile &rarr;
        </a>
    </div>
</div>
