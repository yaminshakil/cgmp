@extends('layouts.admin')

@section('title', $page->exists ? 'Edit Page' : 'New Page')

@section('content')
<form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" class="max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($page->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Title *</span>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            <x-text-style-control name="text_styles[title]" :style="$page->text_styles['title'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Slug <span class="text-gray-400">(leave blank to auto-generate; used in the URL)</span></span>
            <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Body</span>
            <x-trix-field name="body" :value="$page->body" />
            <x-text-style-control name="text_styles[body]" :style="$page->text_styles['body'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Meta title</span>
            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Meta description</span>
            <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.pages.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection
