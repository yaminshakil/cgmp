<footer class="footer-glow relative overflow-hidden border-t border-white/10 bg-[#121212] px-6 pb-10 pt-14 text-blue-100 sm:pb-16 sm:pt-20">
    <div class="footer-fx pointer-events-none absolute inset-0" aria-hidden="true">
        <span class="footer-orb footer-orb-a"></span>
        <span class="footer-orb footer-orb-b"></span>
    </div>

    <div class="reveal-stagger relative mx-auto grid max-w-6xl grid-cols-2 gap-x-6 gap-y-10 sm:gap-y-12 md:grid-cols-4 md:gap-12">
        <div data-reveal="left" class="col-span-2 md:col-span-1">
            <span class="footer-logo flex justify-center md:justify-start"><x-logo light large /></span>
            <p class="mt-5 text-sm leading-6 text-blue-100/70 sm:mt-7 sm:text-base sm:leading-7">{{ setting('footer_text') }}</p>
            <div class="mt-5 flex gap-2 sm:mt-7">
                @if(setting('facebook_url'))
                    <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener" aria-label="Facebook" class="btn-lift flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-blue-100/70 transition-colors hover:border-brand-red hover:bg-brand-red hover:text-white sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7H8v-2.9h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6v1.9H16l-.4 2.9h-2.1v7A10 10 0 0 0 22 12Z"/></svg>
                    </a>
                @endif
                @if(setting('instagram_url'))
                    <a href="{{ setting('instagram_url') }}" target="_blank" rel="noopener" aria-label="Instagram" class="btn-lift flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 bg-white/5 text-blue-100/70 transition-colors hover:border-brand-red hover:bg-brand-red hover:text-white sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                @endif
            </div>
            <svg class="footer-col-ecg mt-6 h-9 w-full max-w-[280px] text-[#4fb3ea] sm:mt-8" viewBox="0 0 600 60" preserveAspectRatio="none" fill="none" aria-hidden="true"><g class="hero-photo-ecg-track" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/><path transform="translate(600)" d="M0 30h50l8-6 8 6h12l6-26 10 50 8-24h60l5-12 8 24 6-12h70l8-6 8 6h10l6-20 10 40 8-20h40l5-10 8 20 6-10h60l6-26 10 50 8-24H600"/></g></svg>
        </div>

        @php
            $configuredFooterLinks = section_data('footer_links')['items'] ?? [];
            $footerLinks = count($configuredFooterLinks)
                ? $configuredFooterLinks
                : [
                    ['label' => 'About', 'url' => route('about')],
                    ['label' => 'Services', 'url' => route('services.index')],
                    ['label' => 'Doctors', 'url' => route('doctors')],
                    ['label' => 'Blog', 'url' => route('blog.index')],
                    ['label' => 'FAQ', 'url' => route('faq')],
                    ['label' => 'Contact', 'url' => route('contact')],
                    ['label' => 'Emergency', 'url' => route('emergency')],
                ];
        @endphp
        <div data-reveal>
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Quick Links</h3>
            <div class="mt-5 grid gap-2.5 text-sm sm:mt-6">
                @foreach($footerLinks as $link)
                    <a href="{{ $link['url'] }}" class="group flex w-fit items-center gap-1.5 text-blue-100/70 transition-colors duration-200 hover:text-white">
                        <span class="text-brand-red transition-transform duration-200 group-hover:translate-x-0.5">&rsaquo;</span>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div data-reveal>
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Our Services</h3>
            <div class="mt-5 grid gap-2.5 text-sm sm:mt-6">
                @foreach(\App\Models\Service::active()->get() as $footerService)
                    <a href="{{ route('services.show', $footerService) }}" class="group flex w-fit items-center gap-1.5 text-blue-100/70 transition-colors duration-200 hover:text-white">
                        <span class="text-brand-red transition-transform duration-200 group-hover:translate-x-0.5">&rsaquo;</span>
                        {{ $footerService->title }}
                    </a>
                @endforeach
            </div>
        </div>

        <div data-reveal="right" class="col-span-2 md:col-span-1">
            <h3 class="text-xs font-bold uppercase tracking-wider text-white">Contact &amp; Hours</h3>
            <div class="mt-5 grid gap-3.5 text-sm sm:mt-6">
                <div class="footer-contact-row group flex items-start gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-brand-red transition-transform duration-300 group-hover:scale-125" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span class="text-blue-100/70">{{ setting('address_line1') }}, {{ setting('address_suburb') }}</span>
                </div>
                <div class="footer-contact-row group flex items-start gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-brand-red transition-transform duration-300 group-hover:scale-125" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span class="text-blue-100/70">{{ setting('phone') }}</span>
                </div>
                <div class="footer-contact-row group flex items-start gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-brand-red transition-transform duration-300 group-hover:scale-125" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    <span class="break-all text-blue-100/70">{{ setting('contact_email') }}</span>
                </div>
                <div class="footer-contact-row group flex items-start gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-brand-red transition-transform duration-300 group-hover:scale-125" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    <span class="text-blue-100/70">Opening Hours<br><span class="whitespace-pre-line">{{ setting('opening_hours') }}</span></span>
                </div>
            </div>
        </div>
    </div>

    <div data-reveal class="relative mx-auto mt-10 flex max-w-6xl flex-wrap items-center justify-between gap-3 border-t border-white/10 pt-6 text-xs text-blue-100/60 sm:mt-14 sm:pt-7 sm:text-sm">
        <span>{{ setting('copyright_text') ?: '© '.now()->year.' '.setting('clinic_name').'. All rights reserved.' }}</span>
        <span class="flex flex-wrap gap-x-5 gap-y-1">
            @foreach(\App\Models\Page::query()->orderBy('title')->get(['title', 'slug']) as $footerPage)
                <a href="{{ route('pages.show', $footerPage->slug) }}" class="hover:text-white hover:underline">{{ $footerPage->title }}</a>
            @endforeach
        </span>
    </div>
</footer>

<button
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => show = window.scrollY > 500, { passive: true })"
    x-show="show"
    x-cloak
    x-transition.opacity
    @click="window.scrollTo({top: 0, behavior: 'smooth'})"
    aria-label="Back to top"
    class="btn-lift fixed bottom-24 right-5 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-brand-blue text-white shadow-xl hover:bg-brand-blue-dark lg:bottom-6 lg:right-6 lg:h-14 lg:w-14"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
</button>
