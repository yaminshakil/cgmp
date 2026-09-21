@extends('layouts.admin')

@section('title', $service->exists ? 'Edit Service' : 'New Service')

@section('content')
<form method="POST" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data" class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">
    @csrf
    @if($service->exists) @method('PUT') @endif

    <div class="grid gap-5">
        <label class="block">
            <span class="text-sm font-semibold">Title *</span>
            <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="mt-1 w-full rounded-lg border-gray-300">
            @error('title')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            <x-text-style-control name="text_styles[title]" :style="$service->text_styles['title'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Slug <span class="text-gray-400">(leave blank to auto-generate)</span></span>
            <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="mt-1 w-full rounded-lg border-gray-300">
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Icon key</span>
            <select name="icon" class="mt-1 w-full rounded-lg border-gray-300">
                @foreach(['stethoscope', 'brain', 'user-round', 'heart-pulse', 'activity'] as $icon)
                    <option value="{{ $icon }}" @selected(old('icon', $service->icon) === $icon)>{{ $icon }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Short description (shown on cards)</span>
            <textarea name="short_description" class="mt-1 w-full rounded-lg border-gray-300" rows="2">{{ old('short_description', $service->short_description) }}</textarea>
            <x-text-style-control name="text_styles[short_description]" :style="$service->text_styles['short_description'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Full description (shown on the service page)</span>
            <textarea name="description" class="mt-1 w-full rounded-lg border-gray-300" rows="5">{{ old('description', $service->description) }}</textarea>
            <x-text-style-control name="text_styles[description]" :style="$service->text_styles['description'] ?? null" />
        </label>

        <label class="block">
            <span class="text-sm font-semibold">Cover image <span class="text-gray-400">(shown on the service card and at the top of the service page)</span></span>
            <input type="file" name="image" accept="image/*" class="mt-1 w-full">
            @if($service->image)
                <img src="{{ image_url($service->image) }}" class="mt-2 h-24 rounded-lg object-cover" alt="">
                <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                    Remove image
                </label>
            @endif
        </label>

        <div class="block">
            <label class="block">
                <span class="text-sm font-semibold">Gallery images <span class="text-gray-400">(optional; select several at once, up to 12 in total, shown on the service page)</span></span>
                <input type="file" name="gallery[]" accept="image/*" multiple class="mt-1 w-full">
            </label>
            @error('gallery.*')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
            @if(!empty($service->gallery))
                <div class="mt-3 grid grid-cols-3 gap-3 sm:grid-cols-4">
                    @foreach($service->gallery as $path)
                        <label class="block text-xs text-gray-600">
                            <img src="{{ image_url($path) }}" class="h-20 w-full rounded-lg object-cover" alt="">
                            <span class="mt-1 flex items-center gap-1"><input type="checkbox" name="remove_gallery[]" value="{{ $path }}" class="rounded border-gray-300"> Remove</span>
                        </label>
                    @endforeach
                </div>
            @endif
        </div>

        <label class="block">
            <span class="text-sm font-semibold">Sort order</span>
            <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="mt-1 w-32 rounded-lg border-gray-300">
        </label>

        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $service->is_active ?? true)) class="rounded border-gray-300">
            <span class="text-sm font-semibold">Active (shown on the public site)</span>
        </label>
    </div>

    <div class="mt-6 flex gap-3">
        <button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save</button>
        <a href="{{ route('admin.services.index') }}" class="rounded-lg border px-5 py-2 font-semibold">Cancel</a>
    </div>
</form>
@endsection
