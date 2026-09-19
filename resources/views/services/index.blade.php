@extends('layouts.public')

@section('title', 'Our Services')

@section('content')
<section class="bg-gradient-to-r from-brand-blue-darker via-brand-blue-dark to-brand-blue px-6 py-16 text-center">
    <h1 class="font-serif text-3xl font-bold text-white md:text-4xl">Our Medical Services</h1>
    <p class="mx-auto mt-3 max-w-2xl text-base text-white/85 md:text-lg">Comprehensive healthcare for every stage of life. From routine check-ups to complex care management.</p>
</section>

<section class="bg-brand-blue-tint dark:bg-[#1a1a1a] px-6 py-16">
    <div class="reveal-stagger mx-auto grid max-w-6xl gap-7 md:grid-cols-3">
        @foreach($services as $service)
            <x-service-card :service="$service" />
        @endforeach
    </div>
</section>
@endsection
