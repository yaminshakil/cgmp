<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slug
{
    /** Slugs a CMS page must not take, because a real route with the same URL already exists. */
    private const RESERVED_PAGE_SLUGS = [
        'admin', 'login', 'logout', 'register', 'dashboard', 'profile', 'forgot-password', 'reset-password',
        'verify-email', 'confirm-password', 'email', 'password', 'contact', 'about', 'doctors', 'services',
        'blog', 'faq', 'emergency', 'book-appointment', 'sitemap.xml', 'storage', 'up',
    ];

    /**
     * Builds a URL slug from $value (or $fallback when it slugs to nothing) that no other row
     * of $model uses, adding -2, -3, ... on a clash. The DB has a unique index on `slug`, so
     * without this a duplicate title crashes with a 500.
     */
    public static function unique(string $model, ?string $value, string $fallback, ?int $ignoreId = null, array $reserved = []): string
    {
        $base = Str::slug((string) $value) ?: $fallback;
        $slug = $base;
        $i = 2;

        /** @var Model $instance */
        $instance = new $model;

        while (
            in_array($slug, $reserved, true)
            || $instance->newQuery()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where($instance->getKeyName(), '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public static function uniquePage(string $model, ?string $value, string $fallback, ?int $ignoreId = null): string
    {
        return static::unique($model, $value, $fallback, $ignoreId, self::RESERVED_PAGE_SLUGS);
    }
}
