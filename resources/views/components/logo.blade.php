@props(['light' => false, 'showText' => true, 'showTagline' => true, 'collapseOnScroll' => false, 'large' => false])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center gap-1 ' . ($light ? 'text-white' : 'text-brand-blue')]) }}>
    @if(setting('logo_path'))
        <img src="{{ image_url(setting('logo_path')) }}" alt="{{ setting('clinic_name', 'Clinic logo') }}" class="logo-mark h-[66px] w-[120px] shrink-0 object-contain">
    @else
        <div class="logo-mark relative h-[66px] w-[120px] shrink-0">
            <div class="absolute left-[9px] top-[15px] h-[15px] w-24 -rotate-12 rounded-[100%] border-t-[9px] border-brand-blue"></div>
            <div class="absolute left-9 top-1.5 h-[54px] w-24 -rotate-[30deg] rounded-[100%] border-t-[11px] border-brand-red"></div>
        </div>
    @endif
    @if($showText)
        <div @if($collapseOnScroll) x-show="!scrolled" x-transition.opacity.duration.200ms @endif class="text-center uppercase leading-[1.4]" style="font-family: 'Montserrat', 'Poppins', 'Century Gothic', sans-serif; font-weight: 600;">
            <div class="{{ $large ? 'text-[11px]' : 'whitespace-nowrap text-[9px]' }}" style="color: #C9B5F0; letter-spacing: .7px;">Cringila General Medical Practice</div>
            @if($showTagline)
                <div class="mt-1 whitespace-nowrap {{ $large ? 'text-[8.5px]' : 'text-[7px]' }} {{ $light ? 'text-white/70' : 'text-[#4A4A4A] dark:text-white/70' }}" style="letter-spacing: 2.5px;">Your Health. Our Priority</div>
            @endif
        </div>
    @endif
</div>
