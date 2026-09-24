@props(['services', 'cols' => 4, 'marquee' => false])

@if($marquee)
    @php $list = $services->values(); $count = $list->count(); @endphp
    {{-- Auto-scrolling strip: the list is duplicated once so the loop from 0% to -50% is seamless --}}
    <div {{ $attributes->merge(['class' => 'services-marquee relative overflow-hidden']) }}>
        <div class="services-marquee-track flex w-max gap-4" style="--marquee-count: {{ max($count, 1) }}">
            @foreach($list->concat($list) as $i => $service)
                <div class="w-[240px] shrink-0 sm:w-[280px]">
                    <x-service-tile
                        :service="$service"
                        :index="$i % max($count, 1)"
                        :info="$i % 2 === 0"
                        :reveal="false"
                        :decorative="$i >= $count"
                    />
                </div>
            @endforeach
        </div>
    </div>
@else
    {{-- Checkerboard of light info tiles and photo tiles, like an editorial card wall --}}
    <div {{ $attributes->merge(['class' => 'reveal-stagger grid grid-cols-1 gap-4 sm:grid-cols-2 ' . ($cols === 4 ? 'lg:grid-cols-4' : 'lg:grid-cols-3')]) }}>
        @foreach($services->values() as $i => $service)
            <x-service-tile :service="$service" :index="$i" :info="(($i + intdiv($i, $cols)) % 2) === 0" />
        @endforeach
    </div>
@endif
