<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /** All settings, loaded once per process and dropped whenever a setting changes. */
    protected static ?array $cache = null;

    protected static function booted(): void
    {
        static::saved(fn () => static::$cache = null);
        static::deleted(fn () => static::$cache = null);
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        static::$cache ??= static::query()->pluck('value', 'key')->all();

        return static::$cache[$key] ?? $default;
    }
}
