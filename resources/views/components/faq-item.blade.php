@props(['question', 'answer', 'open' => false, 'styles' => null])

<details @if($open) open @endif class="group rounded-xl bg-[#f4f6f8] transition-colors duration-300 open:bg-[#eaf0f6] dark:bg-[#1c1c1c] dark:open:bg-[#242424]" data-reveal>
    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 px-5 py-5 text-ink dark:text-white sm:px-7 sm:py-6 [&::-webkit-details-marker]:hidden">
        <span style="{{ text_style($styles, 'question') }}" class="min-w-0 text-base font-medium leading-snug sm:text-lg">{{ $question }}</span>
        <span class="relative h-5 w-5 shrink-0 text-ink dark:text-white transition-transform duration-300 group-open:rotate-180" aria-hidden="true">
            <span class="absolute left-0 top-1/2 h-[2px] w-full -translate-y-1/2 bg-current"></span>
            <span class="absolute left-1/2 top-0 h-full w-[2px] -translate-x-1/2 bg-current transition-transform duration-300 group-open:scale-y-0"></span>
        </span>
    </summary>
    <p style="{{ text_style($styles, 'answer') }}" class="px-5 pb-6 text-sm leading-6 text-ink-muted dark:text-white/65 sm:px-7 sm:pb-7 sm:text-[15px] sm:leading-7">{{ $answer }}</p>
</details>
