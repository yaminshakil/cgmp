<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    protected $fillable = [
        'author_id', 'category_id', 'title', 'slug', 'excerpt', 'body',
        'featured_image', 'featured_image_alt', 'status', 'published_at',
        'meta_title', 'meta_description', 'text_styles',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'text_styles' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->title . ' | ' . setting('clinic_name');
    }
}
