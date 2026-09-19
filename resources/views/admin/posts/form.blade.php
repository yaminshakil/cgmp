@extends('layouts.admin')

@section('title', $post->exists ? 'Edit Post' : 'New Post')

@section('content')
<form method="POST" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" enctype="multipart/form-data" class="max-w-3xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($post->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Title *</span>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            <x-text-style-control name="text_styles[title]" :style="$post->text_styles['title'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Slug <span class="text-gray-400">(leave blank to auto-generate)</span></span>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block">
                <span class="text-sm font-semibold">Category</span>
                <select name="category_id" class="mt-1 w-full rounded-lg border-gray-300">
                    <option value="">— None —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Status</span>
                <select name="status" class="mt-1 w-full rounded-lg border-gray-300">
                    <option value="draft" @selected(old('status', $post->status ?? 'draft') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $post->status) === 'published')>Published</option>
                </select>
            </label>
        </div>

        <label class="block">
            <span class="text-sm font-semibold">Published at <span class="text-gray-400">(leave blank to use now, when publishing)</span></span>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Excerpt</span>
            <textarea name="excerpt" class="mt-1 w-full rounded-lg border-gray-300" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
            <x-text-style-control name="text_styles[excerpt]" :style="$post->text_styles['excerpt'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Body *</span>
            <x-trix-field name="body" :value="$post->body" />
            <x-text-style-control name="text_styles[body]" :style="$post->text_styles['body'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Featured image</span>
            <input type="file" name="featured_image" accept="image/*" class="mt-1 w-full">
            @if($post->featured_image)
                <img src="{{ image_url($post->featured_image) }}" class="mt-2 h-24 rounded-lg object-cover" alt="">
                <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remove_featured_image" value="1" class="rounded border-gray-300">
                    Remove image
                </label>
            @endif
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Featured image alt text</span>
            <input type="text" name="featured_image_alt" value="{{ old('featured_image_alt', $post->featured_image_alt) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Meta title</span>
            <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Meta description</span>
            <input type="text" name="meta_description" value="{{ old('meta_description', $post->meta_description) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.posts.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection
