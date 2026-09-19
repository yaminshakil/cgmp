@props(['size' => 'default'])

@php
    $padding = $size === 'lg' ? 'px-7 py-5' : 'px-6 py-4';
@endphp

<a href="{{ booking_url() }}" @if(booking_is_external()) target="_blank" rel="noopener" @endif {{ $attributes->merge(['class' => "btn-lift inline-flex items-center gap-3 rounded-2xl bg-brand-red {$padding} font-bold text-white shadow-lg hover:bg-brand-red-dark"]) }}>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18m-9 4h.01M8 14h.01M16 14h.01M8 18h.01M12 18h.01M16 18h.01"/></svg>
    Book Appointment
</a>
