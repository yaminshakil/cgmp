@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-[#062238]']) }}>
    {{ $value ?? $slot }}
</label>
