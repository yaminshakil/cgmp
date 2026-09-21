@props(['faqs', 'showAllLink' => false])

<section class="bg-white px-6 py-16 text-[#062238] dark:bg-[#0b0b0b] dark:text-white md:py-24">
    <div class="mx-auto grid max-w-[1200px] gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] lg:gap-20">
        <div data-reveal="left" class="lg:sticky lg:top-28 lg:self-start">
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-brand-red">FAQ</p>
            <h2 class="mt-3 text-3xl font-semibold leading-[1.12] tracking-tight sm:text-4xl lg:text-5xl">Frequently asked questions</h2>
            <p class="mt-5 max-w-md text-sm leading-6 text-[#60758d] dark:text-white/55 sm:text-base sm:leading-7">Clear answers about our services, booking and policies, so you know what to expect before you visit {{ setting('clinic_name') }}.</p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                @if($showAllLink)
                    <a href="{{ route('faq') }}" class="btn-lift inline-flex items-center gap-2 rounded-xl border border-[#062238]/25 px-6 py-3 text-sm font-semibold text-[#062238] hover:bg-[#062238]/5 dark:border-white/25 dark:text-white dark:hover:bg-white/10">
                        View all FAQs
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @endif
                <a href="{{ route('contact') }}" class="btn-lift inline-flex items-center gap-2 rounded-xl bg-brand-red px-6 py-3 text-sm font-semibold text-white hover:bg-brand-red-dark">
                    Ask us a question
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="grid content-start gap-4">
            @forelse($faqs as $index => $faq)
                <x-faq-item :question="$faq->question" :answer="$faq->answer" :open="$index === 0" :styles="$faq->text_styles" />
            @empty
                <p class="text-[#60758d] dark:text-white/60">No FAQs yet.</p>
            @endforelse
        </div>
    </div>
</section>
