<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'meta_title', 'meta_description', 'text_styles'];

    protected $casts = [
        'text_styles' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
