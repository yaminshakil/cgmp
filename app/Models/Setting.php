<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, ?string $default = null): ?string
    {
        static $cache = null;

        if ($cache === null) {
            $cache = static::query()->pluck('value', 'key')->all();
        }

        return $cache[$key] ?? $default;
    }
}
