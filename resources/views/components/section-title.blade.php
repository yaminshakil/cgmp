@props(['eyebrow', 'title', 'copy' => null, 'nowrap' => false, 'eyebrowClass' => 'rounded-full bg-brand-blue-tint dark:bg-white/10 px-5 py-3 text-xs font-bold uppercase tracking-[.18em] text-[#062238] dark:text-[#e0e0e0]', 'titleStyle' => null, 'titleClass' => null, 'copyClass' => null, 'copyColor' => 'text-[#45627d] dark:text-white/60'])

<div data-reveal class="mx-auto text-center {{ $nowrap ? 'max-w-6xl' : 'max-w-4xl' }}">
    <span class="inline-block {{ $eyebrowClass }}">{{ $eyebrow }}</span>
    <h2 @if($titleStyle) style="{{ $titleStyle }}" @endif class="mt-6 font-serif font-bold text-[#062238] dark:text-[#e0e0e0] {{ $titleClass ?? ($nowrap ? 'text-2xl sm:whitespace-nowrap sm:text-3xl md:text-4xl lg:text-5xl' : 'text-4xl md:text-6xl') }}">{{ $title }}</h2>
    @if($copy)
        <p class="mt-5 {{ $copyClass ?? 'text-lg leading-8' }} {{ $copyColor }}">{{ $copy }}</p>
    @endif
</div>
