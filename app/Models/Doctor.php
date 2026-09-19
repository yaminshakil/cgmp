<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'role', 'qualifications', 'photo', 'bio', 'years_experience', 'languages',
        'availability_days', 'sort_order', 'is_active', 'text_styles',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'availability_days' => 'array',
        'text_styles' => 'array',
    ];

    public function languageList(): array
    {
        return $this->languages
            ? array_filter(array_map('trim', explode(',', $this->languages)))
            : [];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('name');
    }
}
