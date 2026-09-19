@extends('layouts.public')

@section('title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description)

@section('content')
<section class="px-6 py-24">
    <div class="mx-auto max-w-3xl" data-reveal>
        <x-section-title eyebrow="Information" :title="$page->title" :titleStyle="text_style($page->text_styles, 'title')" />
        <div style="{{ text_style($page->text_styles, 'body') }}" class="prose mt-10 leading-8 text-[#45627d] dark:text-white/60">
            {!! $page->body !!}
        </div>
    </div>
</section>
@endsection
