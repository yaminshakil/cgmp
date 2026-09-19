@extends('layouts.admin')

@section('title', 'Homepage Sections')

@section('content')
<div class="grid gap-8">
    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Hero Section</h2>
        <form method="POST" action="{{ route('admin.sections.hero') }}" enctype="multipart/form-data" class="mt-4 grid gap-4">
            @csrf @method('PUT')
            <label class="block">
                <span class="text-sm font-semibold">Heading *</span>
                <input type="text" name="heading" value="{{ old('heading', $hero['heading'] ?? '') }}" required class="mt-1 w-full rounded-lg border-gray-300">
                <x-text-style-control name="text_styles[heading]" :style="$hero['styles']['heading'] ?? null" />
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Subheading</span>
                <textarea name="subheading" class="mt-1 w-full rounded-lg border-gray-300" rows="2">{{ old('subheading', $hero['subheading'] ?? '') }}</textarea>
                <x-text-style-control name="text_styles[subheading]" :style="$hero['styles']['subheading'] ?? null" />
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Badge text</span>
                <input type="text" name="badge_text" value="{{ old('badge_text', $hero['badge_text'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
                <x-text-style-control name="text_styles[badge_text]" :style="$hero['styles']['badge_text'] ?? null" />
            </label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="text-sm font-semibold">Primary button text</span>
                    <input type="text" name="primary_button_text" value="{{ old('primary_button_text', $hero['primary_button_text'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Primary button link</span>
                    <input type="text" name="primary_button_link" value="{{ old('primary_button_link', $hero['primary_button_link'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Secondary button text</span>
                    <input type="text" name="secondary_button_text" value="{{ old('secondary_button_text', $hero['secondary_button_text'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
                </label>
                <label class="block">
                    <span class="text-sm font-semibold">Secondary button link</span>
                    <input type="text" name="secondary_button_link" value="{{ old('secondary_button_link', $hero['secondary_button_link'] ?? '') }}" class="mt-1 w-full rounded-lg border-gray-300">
                </label>
            </div>
            <label class="block">
                <span class="text-sm font-semibold">Hero image</span>
                <input type="file" name="image" accept="image/*" class="mt-1 w-full">
                @if(!empty($hero['image']))
                    <img src="{{ image_url($hero['image']) }}" class="mt-2 h-24 rounded-lg object-cover" alt="">
                    <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                        Remove image
                    </label>
                @endif
            </label>
            <div><button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save Hero</button></div>
        </form>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">About Section</h2>
        <form method="POST" action="{{ route('admin.sections.about') }}" enctype="multipart/form-data" class="mt-4 grid gap-4">
            @csrf @method('PUT')
            <label class="block">
                <span class="text-sm font-semibold">Heading *</span>
                <input type="text" name="heading" value="{{ old('heading', $about['heading'] ?? '') }}" required class="mt-1 w-full rounded-lg border-gray-300">
                <x-text-style-control name="text_styles[heading]" :style="$about['styles']['heading'] ?? null" />
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Subheading <span class="text-gray-400">(shown on the About page hero)</span></span>
                <textarea name="subheading" class="mt-1 w-full rounded-lg border-gray-300" rows="2">{{ old('subheading', $about['subheading'] ?? '') }}</textarea>
                <x-text-style-control name="text_styles[subheading]" :style="$about['styles']['subheading'] ?? null" />
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Body</span>
                <x-trix-field name="body" :value="$about['body'] ?? ''" id="about-body" />
                <x-text-style-control name="text_styles[body]" :style="$about['styles']['body'] ?? null" />
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Key points <span class="text-gray-400">(one per line)</span></span>
                <textarea name="points" class="mt-1 w-full rounded-lg border-gray-300" rows="3">{{ old('points', implode("\n", $about['points'] ?? [])) }}</textarea>
            </label>
            <label class="block">
                <span class="text-sm font-semibold">Image</span>
                <input type="file" name="image" accept="image/*" class="mt-1 w-full">
                @if(!empty($about['image']))
                    <img src="{{ image_url($about['image']) }}" class="mt-2 h-24 rounded-lg object-cover" alt="">
                    <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                        Remove image
                    </label>
                @endif
            </label>
            <div><button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save About</button></div>
        </form>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Nearest Hospitals (Emergency page)</h2>
        <p class="mt-1 text-sm text-gray-500">One hospital per line, in the format: <code>Name | Distance | Address | Phone</code>. Example: <code>Wollongong Hospital | 5km | Loftus St, Wollongong NSW 2500 | (02) 4222 5000</code></p>
        <form method="POST" action="{{ route('admin.sections.nearest-hospitals') }}" class="mt-4 grid gap-4">
            @csrf @method('PUT')
            <label class="block">
                <span class="text-sm font-semibold">Hospitals</span>
                <textarea name="hospitals" class="mt-1 w-full rounded-lg border-gray-300 font-mono text-sm" rows="4">{{ old('hospitals', collect($nearestHospitals['hospitals'] ?? [])->map(fn ($h) => "{$h['name']} | {$h['distance']} | {$h['address']} | {$h['phone']}")->implode("\n")) }}</textarea>
            </label>
            <div><button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save Hospitals</button></div>
        </form>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Navigation Menu (header)</h2>
        <p class="mt-1 text-sm text-gray-500">One menu item per line, in the format: <code>Label | URL</code>. Order here is the order shown in the menu. Example: <code>Home | /</code></p>
        <form method="POST" action="{{ route('admin.sections.navigation') }}" class="mt-4 grid gap-4">
            @csrf @method('PUT')
            <label class="block">
                <span class="text-sm font-semibold">Menu items</span>
                @php
                    $defaultNavItems = [
                        ['label' => 'Home', 'url' => route('home')],
                        ['label' => 'About', 'url' => route('about')],
                        ['label' => 'Services', 'url' => route('services.index')],
                        ['label' => 'Doctors', 'url' => route('doctors')],
                        ['label' => 'Blog', 'url' => route('blog.index')],
                        ['label' => 'Contact', 'url' => route('contact')],
                    ];
                    $navItemsForDisplay = $navigation['items'] ?? $defaultNavItems;
                @endphp
                <textarea name="items" class="mt-1 w-full rounded-lg border-gray-300 font-mono text-sm" rows="6">{{ old('items', collect($navItemsForDisplay)->map(fn ($i) => "{$i['label']} | {$i['url']}")->implode("\n")) }}</textarea>
            </label>
            <div><button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save Navigation</button></div>
        </form>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-bold">Footer Links (Quick Links)</h2>
        <p class="mt-1 text-sm text-gray-500">One link per line, in the format: <code>Label | URL</code>. Example: <code>About | /about</code></p>
        <form method="POST" action="{{ route('admin.sections.footer-links') }}" class="mt-4 grid gap-4">
            @csrf @method('PUT')
            <label class="block">
                <span class="text-sm font-semibold">Footer links</span>
                @php
                    $defaultFooterLinks = [
                        ['label' => 'About', 'url' => route('about')],
                        ['label' => 'Services', 'url' => route('services.index')],
                        ['label' => 'Doctors', 'url' => route('doctors')],
                        ['label' => 'Blog', 'url' => route('blog.index')],
                        ['label' => 'FAQ', 'url' => route('faq')],
                        ['label' => 'Contact', 'url' => route('contact')],
                        ['label' => 'Emergency', 'url' => route('emergency')],
                    ];
                    $footerLinksForDisplay = $footerLinks['items'] ?? $defaultFooterLinks;
                @endphp
                <textarea name="items" class="mt-1 w-full rounded-lg border-gray-300 font-mono text-sm" rows="7">{{ old('items', collect($footerLinksForDisplay)->map(fn ($i) => "{$i['label']} | {$i['url']}")->implode("\n")) }}</textarea>
            </label>
            <div><button type="submit" class="rounded-lg bg-brand-blue px-5 py-2 font-semibold text-white">Save Footer Links</button></div>
        </form>
    </div>
</div>
@endsection
