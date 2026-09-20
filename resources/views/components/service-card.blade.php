@props(['service'])

<div class="service-card flex flex-col rounded-[18px] bg-white dark:bg-[#232323] p-4 shadow-lg shadow-[#062238]/10 dark:shadow-white/10 sm:p-5" data-reveal>
    <a href="{{ route('services.show', $service) }}" class="group block flex-1">
        <div class="service-icon-badge mb-3 flex h-10 w-10 items-center justify-center rounded-xl text-xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3 sm:mb-4 sm:h-11 sm:w-11">
            <x-service-icon :name="$service->icon" class="h-5 w-5 text-white" />
        </div>
        <h3 style="{{ text_style($service->text_styles, 'title') }}" class="font-serif text-base font-bold sm:text-lg">{{ $service->title }}</h3>
        <p style="{{ text_style($service->text_styles, 'short_description') }}" class="mt-1.5 text-xs leading-5 text-[#60758d] dark:text-white/60 sm:mt-2 sm:text-sm sm:leading-6">{{ $service->short_description }}</p>
        <span class="mt-3 flex items-center gap-2 text-xs font-semibold text-brand-blue sm:mt-4 sm:text-sm">
            Learn more
            <svg xmlns="http://www.w3.org/2000/svg" class="learn-more-arrow h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </span>
    </a>
    <a href="{{ booking_url() }}" data-book-appointment @if(booking_is_external() && ! setting('healthengine_id')) target="_blank" rel="noopener" @endif class="btn-lift mt-4 flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-6 py-2 text-xs font-semibold text-white shadow-lg hover:bg-brand-red-dark sm:mt-5 sm:py-2.5 sm:text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        Book Appointment
    </a>
</div>
