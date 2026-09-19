<?php

use App\Models\Section;
use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('section_data')) {
    function section_data(string $key, array $default = []): array
    {
        return Section::data($key, $default);
    }
}

if (! function_exists('image_url')) {
    function image_url(?string $path, string $fallback = ''): string
    {
        if ($path && str_starts_with($path, 'http')) {
            return $path;
        }

        if ($path && str_starts_with($path, 'images/')) {
            return asset($path);
        }

        if ($path && trim($path) !== '') {
            return asset('storage/' . ltrim($path, '/'));
        }

        return $fallback !== '' ? asset($fallback) : '';
    }
}

if (! function_exists('booking_url')) {
    function booking_url(): string
    {
        return setting('healthengine_url') ?: route('booking');
    }
}

if (! function_exists('booking_is_external')) {
    function booking_is_external(): bool
    {
        return (bool) setting('healthengine_url');
    }
}

if (! function_exists('text_style')) {
    /**
     * Inline `style` attribute value for an admin-configurable text field.
     * $styles is a field-name => ['size' => ..., 'font' => ...] map (a model's
     * text_styles column, or a section's content['styles']).
     */
    function text_style(?array $styles, string $field): string
    {
        return \App\Support\TextStyles::css($styles[$field] ?? null);
    }
}
