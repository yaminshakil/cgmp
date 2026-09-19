@extends('layouts.public')

@section('title', 'FAQ')

@section('content')
<section class="px-6 py-24">
    <x-section-title eyebrow="FAQ" title="Frequently Asked Questions" copy="Find answers to the most common questions about our services, booking, and policies." eyebrowClass="px-4 py-1 bg-[#EBF3FC] dark:bg-white/10 text-[#002B49] dark:text-[#e0e0e0] font-bold text-xs rounded-full uppercase tracking-wide" />
    <div class="mx-auto mt-14 grid max-w-4xl gap-4">
        @forelse($faqs as $index => $faq)
            <x-faq-item :question="$faq->question" :answer="$faq->answer" :open="$index === 0" :styles="$faq->text_styles" />
        @empty
            <p class="text-center text-[#60758d] dark:text-white/60">No FAQs yet.</p>
        @endforelse
    </div>
</section>
@endsection
