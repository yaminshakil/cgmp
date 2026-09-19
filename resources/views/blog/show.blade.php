@extends('layouts.public')

@section('title', $post->title)
@section('meta_description', $post->excerpt)

@section('content')
<section class="px-6 py-24">
    <article class="mx-auto max-w-3xl" data-reveal>
        <div class="flex flex-wrap items-center gap-3 text-sm text-[#60758d] dark:text-white/60">
            @if($post->category)
                <span class="rounded-full bg-brand-blue-tint dark:bg-white/10 px-3 py-1 text-xs font-semibold text-[#062238] dark:text-[#e0e0e0]">{{ $post->category->name }}</span>
            @endif
            <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('j F Y') }}</time>
        </div>
        <h1 style="{{ text_style($post->text_styles, 'title') }}" class="mt-5 font-serif text-4xl font-bold text-[#062238] dark:text-[#e0e0e0] md:text-5xl">{{ $post->title }}</h1>

        @if($post->featured_image)
            <img src="{{ image_url($post->featured_image) }}" alt="{{ $post->featured_image_alt ?: $post->title }}" class="mt-8 aspect-[16/8] w-full rounded-3xl object-cover shadow-xl">
        @endif

        <div style="{{ text_style($post->text_styles, 'body') }}" class="prose mt-10 max-w-none text-lg leading-8 text-[#45627d] dark:text-white/60">
            {!! $post->body !!}
        </div>

        <div class="mt-10 flex items-center gap-3 border-t border-slate-100 dark:border-white/10 pt-8" x-data="{
            copied: false,
            copyLink() {
                navigator.clipboard.writeText(window.location.href);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            }
        }">
            <span class="text-sm font-semibold text-[#60758d] dark:text-white/60">Share:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on Facebook" class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue hover:bg-brand-blue hover:text-white hover:scale-110 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7H8v-2.9h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6v1.9H16l-.4 2.9h-2.1v7A10 10 0 0 0 22 12Z"/></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" aria-label="Share on X" class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue hover:bg-brand-blue hover:text-white hover:scale-110 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.9 2H22l-7.6 8.7L23 22h-6.9l-5.4-6.6L4.4 22H1.3l8.2-9.3L1 2h7.1l4.9 6.1L18.9 2Zm-1.2 18h1.9L7.4 4h-2l12.3 16Z"/></svg>
            </a>
            <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(url()->current()) }}" aria-label="Share via email" class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue hover:bg-brand-blue hover:text-white hover:scale-110 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
            </a>
            <button type="button" @click="copyLink" aria-label="Copy link" class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-blue-tint dark:bg-white/10 text-brand-blue hover:bg-brand-blue hover:text-white hover:scale-110 transition-all">
                <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.07 0l2.83-2.83a5 5 0 0 0-7.07-7.07L11 4.75M14 11a5 5 0 0 0-7.07 0l-2.83 2.83a5 5 0 0 0 7.07 7.07L13 19.25"/></svg>
                <svg x-show="copied" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </button>
        </div>
    </article>

    @if($related->isNotEmpty())
        <div class="mx-auto mt-20 max-w-6xl">
            <h2 class="font-serif text-2xl font-bold text-[#062238] dark:text-[#e0e0e0]">Related posts</h2>
            <div class="reveal-stagger mt-8 grid gap-7 md:grid-cols-3">
                @foreach($related as $item)
                    <x-post-card :post="$item" />
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
