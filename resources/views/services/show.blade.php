@extends('layouts.public')

@section('title', $service->title)
@section('meta_description', $service->short_description)

@section('content')
<section class="px-6 py-24">
    <div class="mx-auto max-w-4xl" data-reveal>
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-blue-tint dark:bg-white/10">
            <x-service-icon :name="$service->icon" class="h-8 w-8 text-brand-blue" />
        </div>
        <h1 style="{{ text_style($service->text_styles, 'title') }}" class="mt-7 font-serif text-4xl font-bold text-[#062238] dark:text-[#e0e0e0] md:text-5xl">{{ $service->title }}</h1>
        <p style="{{ text_style($service->text_styles, 'short_description') }}" class="mt-5 text-lg leading-8 text-[#45627d] dark:text-white/60">{{ $service->short_description }}</p>
        @if($service->description)
            <div style="{{ text_style($service->text_styles, 'description') }}" class="prose mt-8 leading-8 text-[#45627d] dark:text-white/60">{!! nl2br(e($service->description)) !!}</div>
        @endif
        <div class="mt-10">
            <x-booking-button />
        </div>
    </div>

    @if($others->isNotEmpty())
        <div class="mx-auto mt-20 max-w-6xl">
            <h2 class="font-serif text-2xl font-bold text-[#062238] dark:text-[#e0e0e0]">Other services</h2>
            <div class="reveal-stagger mt-8 grid gap-7 md:grid-cols-3">
                @foreach($others as $other)
                    <x-service-card :service="$other" />
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
