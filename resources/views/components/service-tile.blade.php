@props(['service', 'index' => 0, 'info' => true])

@php $cover = $service->coverImage(); @endphp

<a href="{{ route('services.show', $service) }}" class="service-tile group relative block aspect-[4/3] overflow-hidden sm:aspect-[7/10] rounded-[18px] {{ $info ? 'bg-gradient-to-br from-[#cfe1ec] via-[#dfe6f2] to-[#eadfea] text-[#1c2b3a] shadow-sm ring-1 ring-black/5' : 'bg-gradient-to-br from-brand-blue-dark to-brand-blue text-white' }}" data-reveal>
    @if($info)
        <div class="absolute inset-x-3 top-3 h-[52%] overflow-hidden rounded-xl bg-white/50 ring-1 ring-black/5">
            @if($cover)
                <img src="{{ image_url($cover) }}" alt="" loading="lazy" class="h-full w-full object-cover">
            @else
                <span class="flex h-full w-full items-center justify-center text-brand-blue/40"><x-service-icon :name="$service->icon" class="h-16 w-16" /></span>
            @endif
        </div>
        <div class="absolute inset-x-0 bottom-0 p-5">
            <span class="block text-right font-mono text-xs text-[#1c2b3a]/60">/{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <h3 style="{{ text_style($service->text_styles, 'title') }}" class="mt-2 text-[15px] font-semibold leading-snug">{{ $service->title }}</h3>
            @if($service->short_description)
                <p style="{{ text_style($service->text_styles, 'short_description') }}" class="mt-2 line-clamp-3 text-[13px] leading-5 text-[#1c2b3a]/70">{{ $service->short_description }}</p>
            @endif
        </div>
    @else
        @if($cover)
            <img src="{{ image_url($cover) }}" alt="" loading="lazy" class="absolute inset-0 h-full w-full object-cover">
        @else
            <div class="absolute inset-0 flex items-center justify-center text-white/15"><x-service-icon :name="$service->icon" class="h-24 w-24" /></div>
        @endif
        <div class="absolute inset-0 bg-[#04121f]/35 transition-colors duration-300 group-hover:bg-[#04121f]/55"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 text-center">
            <h3 style="{{ text_style($service->text_styles, 'title') }}" class="text-[15px] font-medium leading-snug drop-shadow">{{ $service->title }}</h3>
        </div>
    @endif
</a>
