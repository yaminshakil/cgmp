@props(['name', 'style' => null])

@php
    $sizeKeys = array_keys(\App\Support\TextStyles::SIZES);
    $currentSize = $style['size'] ?? null;
    $currentIdx = $currentSize && in_array($currentSize, $sizeKeys, true) ? array_search($currentSize, $sizeKeys, true) : -1;
    $currentFont = $style['font'] ?? '';
@endphp

<div
    x-data="{ sizes: {{ Illuminate\Support\Js::from($sizeKeys) }}, idx: {{ $currentIdx }} }"
    class="mt-2 flex flex-wrap items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2"
>
    <span class="text-xs font-semibold uppercase tracking-wide text-gray-400">Text style</span>

    <div class="flex items-center gap-1.5">
        <button
            type="button"
            @click="idx = idx <= 0 ? 0 : idx - 1"
            class="flex h-7 w-7 items-center justify-center rounded-md border border-gray-300 bg-white text-xs font-bold text-gray-600 hover:bg-gray-100"
            aria-label="Decrease text size"
        >A-</button>
        <span class="w-16 text-center text-xs text-gray-600" x-text="idx === -1 ? 'Default' : sizes[idx]"></span>
        <button
            type="button"
            @click="idx = idx >= sizes.length - 1 ? sizes.length - 1 : idx + 1"
            class="flex h-7 w-7 items-center justify-center rounded-md border border-gray-300 bg-white text-xs font-bold text-gray-600 hover:bg-gray-100"
            aria-label="Increase text size"
        >A+</button>
        <button
            type="button"
            x-show="idx !== -1"
            x-cloak
            @click="idx = -1"
            class="ml-1 text-xs text-gray-400 underline hover:text-gray-600"
        >Reset</button>
    </div>

    <input type="hidden" :name="'{{ $name }}[size]'" :value="idx === -1 ? '' : sizes[idx]">

    <label class="flex items-center gap-1.5 text-xs text-gray-600">
        Font
        <select name="{{ $name }}[font]" class="rounded-md border-gray-300 py-1 text-xs">
            @foreach(\App\Support\TextStyles::FONTS as $key => $label)
                <option value="{{ $key }}" @selected($currentFont === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
</div>
