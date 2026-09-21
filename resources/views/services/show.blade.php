@extends('layouts.public')

@section('title', $service->title)
@section('meta_description', $service->short_description ?: setting('tagline', ''))

@section('content')
<section class="px-6 py-24">
    <div class="mx-auto max-w-4xl" data-reveal>
        @if($service->image)
            <img src="{{ image_url($service->image) }}" alt="{{ $service->title }}" class="mb-10 aspect-[16/9] w-full rounded-3xl object-cover shadow-lg">
        @endif
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-brand-blue-tint dark:bg-white/10">
            <x-service-icon :name="$service->icon" class="h-8 w-8 text-brand-blue" />
        </div>
        <h1 style="{{ text_style($service->text_styles, 'title') }}" class="mt-7 font-serif text-4xl font-bold text-[#062238] dark:text-[#e0e0e0] md:text-5xl">{{ $service->title }}</h1>
        <p style="{{ text_style($service->text_styles, 'short_description') }}" class="mt-5 text-lg leading-8 text-[#45627d] dark:text-white/60">{{ $service->short_description }}</p>
        @if($service->description)
            <div style="{{ text_style($service->text_styles, 'description') }}" class="prose mt-8 leading-8 text-[#45627d] dark:text-white/60">{!! nl2br(e($service->description)) !!}</div>
        @endif
        @if(!empty($service->gallery))
            <div class="mt-10 grid gap-4 sm:grid-cols-2">
                @foreach($service->gallery as $path)
                    <img src="{{ image_url($path) }}" alt="{{ $service->title }}" loading="lazy" class="aspect-[4/3] w-full rounded-2xl object-cover shadow-md">
                @endforeach
            </div>
        @endif
        <div class="mt-10">
            <x-booking-button />
        </div>
    </div>

    @if($others->isNotEmpty())
        <div class="mx-auto mt-20 max-w-6xl">
            <h2 class="font-serif text-2xl font-bold text-[#062238] dark:text-[#e0e0e0]">Other services</h2>
            <x-services-grid :services="$others" :cols="3" class="mt-8" />
        </div>
    @endif
</section>
@endsection
