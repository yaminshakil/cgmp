@props(['class' => '', 'label' => 'Book Appointment'])

{{-- Opens the HealthEngine booking popup (see x-booking-modal); falls back to a normal link without JS / without an ID. --}}
<a href="{{ booking_url() }}" data-book-appointment @if(booking_is_external() && ! setting('healthengine_id')) target="_blank" rel="noopener" @endif class="{{ $class }}">{!! $label !!}</a>
