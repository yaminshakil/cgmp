@props(['class' => '', 'label' => 'Book Appointment'])

@if(setting('healthengine_id'))
    <script
        src="https://healthengine.com.au/webplugin/appointments.js"
        data-he-id="{{ setting('healthengine_id') }}"
        data-he-button="true"
        data-he-text="{{ $label }}"
        data-he-button-class="{{ $class }}"
    ></script>
@else
    <a href="{{ booking_url() }}" @if(booking_is_external()) target="_blank" rel="noopener" @endif class="{{ $class }}">{!! $label !!}</a>
@endif
