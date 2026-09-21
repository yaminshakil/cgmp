@props(['services', 'cols' => 4])

{{-- Checkerboard of light info tiles and photo tiles, like an editorial card wall --}}
<div {{ $attributes->merge(['class' => 'reveal-stagger grid grid-cols-1 gap-4 sm:grid-cols-2 ' . ($cols === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3')]) }}>
    @foreach($services->values() as $i => $service)
        <x-service-tile :service="$service" :index="$i" :info="(($i + intdiv($i, $cols)) % 2) === 0" />
    @endforeach
</div>
