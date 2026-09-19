@props(['name' => 'stethoscope'])

@php
    $paths = [
        'stethoscope' => 'M4.8 2.3A.3.3 0 1 0 4.2 2.3.3.3 0 0 0 4.8 2.3M8 2v11.7a5.3 5.3 0 0 0 10.6 0V9.3a2.3 2.3 0 1 0-4.6 0v1.4a1 1 0 0 1-2 0V9.3a4.3 4.3 0 1 1 8.6 0v4.4a7.3 7.3 0 0 1-14.6 0V2M19.2 2.3A.3.3 0 1 0 18.6 2.3.3.3 0 0 0 19.2 2.3',
        'brain' => 'M9.5 2a2.5 2.5 0 0 0-2.5 2.5v.5A2.5 2.5 0 0 0 5 7.5v1A2.5 2.5 0 0 0 3.5 11v1A2.5 2.5 0 0 0 6 14.5V16a3 3 0 0 0 3 3 2 2 0 0 0 2-2V4.5A2.5 2.5 0 0 0 9.5 2M14.5 2A2.5 2.5 0 0 1 17 4.5v.5a2.5 2.5 0 0 1 2 2.5v1a2.5 2.5 0 0 1 1.5 2.5v1A2.5 2.5 0 0 1 18 14.5V16a3 3 0 0 1-3 3 2 2 0 0 1-2-2V4.5A2.5 2.5 0 0 1 14.5 2',
        'user-round' => 'M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10ZM20 21a8 8 0 0 0-16 0',
        'heart-pulse' => 'M19 14c1.5-1.6 3-3.4 3-5.5A5.5 5.5 0 0 0 12 5a5.5 5.5 0 0 0-10 3.5c0 3.8 3.4 6.9 8.6 11.5L12 21l1.5-1.4M3.5 9.5h2l2-4 3 8 2-5h6',
        'activity' => 'M22 12h-4l-3 9L9 3l-3 9H2',
    ];
    $path = $paths[$name] ?? $paths['stethoscope'];
@endphp

<svg xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => 'h-6 w-6']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="{{ $path }}"/>
</svg>
