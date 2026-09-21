<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title', 'slug', 'icon', 'image', 'gallery', 'short_description', 'description', 'sort_order', 'is_active', 'text_styles',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery' => 'array',
        'text_styles' => 'array',
    ];

    /** Image shown on cards: the cover, else the first gallery image. */
    public function coverImage(): ?string
    {
        return $this->image ?: ($this->gallery[0] ?? null);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('title');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
