@props(['question', 'answer', 'open' => false, 'styles' => null])

<details @if($open) open @endif class="group rounded-2xl border border-[#E5E7EB] dark:border-white/10 bg-white dark:bg-[#1a1a1a] open:border-[#A8CFF0] transition-colors" data-reveal>
    <summary class="flex cursor-pointer list-none items-center justify-between gap-4 p-5 font-medium sm:p-6 text-[#1A2B49] dark:text-[#e0e0e0] sm:font-bold">
        <span style="{{ text_style($styles, 'question') }}" class="min-w-0 text-[15px] leading-snug sm:text-[17px]">{{ $question }}</span>
        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#F1F2F4] dark:bg-white/10 text-[#6B7280] dark:text-white/60 transition-all duration-300 group-open:rotate-180 group-open:bg-[#1A2B49] group-open:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
        </span>
    </summary>
    <p style="{{ text_style($styles, 'answer') }}" class="border-t border-[#E5E7EB] dark:border-white/10 px-5 pb-5 pt-4 text-sm leading-6 text-[#6B7280] dark:text-white/60 sm:px-6 sm:pb-6 sm:pt-5">{{ $answer }}</p>
</details>
