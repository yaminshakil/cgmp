<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['key', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    public static function data(string $key, array $default = []): array
    {
        return static::query()->where('key', $key)->value('content') ?? $default;
    }

    public static function store(string $key, array $content): void
    {
        static::query()->updateOrCreate(['key' => $key], ['content' => $content]);
    }
}
