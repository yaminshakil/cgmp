@extends('layouts.public')

@section('title', 'Page Not Found')

@section('content')
<section class="px-6 py-32 text-center">
    <p class="font-serif text-8xl font-extrabold text-brand-blue-tint">404</p>
    <h1 class="mt-4 font-serif text-3xl font-bold text-ink dark:text-[#e0e0e0]">Page not found</h1>
    <p class="mt-4 text-lg text-ink-muted dark:text-white/70">Sorry, we couldn't find the page you're looking for.</p>
    <div class="mt-8 flex flex-wrap justify-center gap-4">
        <a href="{{ route('home') }}" class="rounded-2xl bg-brand-blue px-7 py-4 font-bold text-white hover:bg-brand-blue-dark transition-colors">Back to Home</a>
        <x-booking-button />
    </div>
</section>
@endsection
