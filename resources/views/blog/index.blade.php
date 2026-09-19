@extends('layouts.public')

@section('title', 'Blog')

@section('content')
<section class="bg-gradient-to-r from-brand-blue-darker via-brand-blue-dark to-brand-blue px-6 py-16 text-center">
    <h1 class="mx-auto whitespace-nowrap font-serif text-[7vw] font-bold text-white sm:whitespace-normal sm:text-3xl md:text-4xl">Blog &amp; Health News</h1>
    <p class="mx-auto mt-3 max-w-2xl text-sm text-white/85 sm:text-base md:text-lg">Articles, updates and health advice from our practice.</p>
</section>

<section class="px-6 py-16">
    <form method="GET" action="{{ route('blog.index') }}" class="mx-auto flex max-w-md items-center gap-2 rounded-full border border-slate-200 dark:border-white/10 bg-white dark:bg-[#1a1a1a] px-5 py-3 shadow-sm">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-[#60758d] dark:text-white/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search articles&hellip;" class="w-full border-0 p-0 text-sm focus:ring-0">
        <button type="submit" class="btn-lift shrink-0 rounded-full bg-brand-blue px-4 py-1.5 text-sm font-semibold text-white">Search</button>
    </form>

    <div class="mx-auto mt-6 flex max-w-6xl flex-wrap items-center justify-center gap-3">
        <a href="{{ route('blog.index', request()->only('q')) }}" class="rounded-full px-4 py-2 text-sm font-semibold transition-colors duration-200 {{ request('category') ? 'bg-brand-blue-tint dark:bg-white/10 text-[#062238] dark:text-[#e0e0e0] hover:bg-brand-blue hover:text-white' : 'bg-brand-blue text-white' }}">All</a>
        @foreach($categories as $category)
            <a href="{{ route('blog.index', ['category' => $category->slug] + request()->only('q')) }}" class="rounded-full px-4 py-2 text-sm font-semibold transition-colors duration-200 {{ request('category') === $category->slug ? 'bg-brand-blue text-white' : 'bg-brand-blue-tint dark:bg-white/10 text-[#062238] dark:text-[#e0e0e0] hover:bg-brand-blue hover:text-white' }}">{{ $category->name }}</a>
        @endforeach
    </div>

    @if($posts->isNotEmpty())
        <div class="reveal-stagger mx-auto mt-14 grid max-w-6xl gap-7 md:grid-cols-3">
            @foreach($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>
        <div class="mx-auto mt-14 max-w-6xl">
            {{ $posts->links() }}
        </div>
    @else
        <p class="mt-14 text-center text-[#60758d] dark:text-white/60">No posts yet — check back soon.</p>
    @endif
</section>
@endsection
