<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['key', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    /** All section content, loaded once per process and dropped whenever a section changes. */
    protected static ?array $cache = null;

    protected static function booted(): void
    {
        static::saved(fn () => static::$cache = null);
        static::deleted(fn () => static::$cache = null);
    }

    public static function data(string $key, array $default = []): array
    {
        static::$cache ??= static::query()->get()->pluck('content', 'key')->all();

        return static::$cache[$key] ?? $default;
    }

    public static function store(string $key, array $content): void
    {
        static::query()->updateOrCreate(['key' => $key], ['content' => $content]);
    }
}
