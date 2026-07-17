<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'icon', 'excerpt', 'description', 'image',
        'hero_image', 'featured_image', 'content_banner', 'author_name',
        'author_role', 'author_bio', 'read_time', 'tags', 'published_at', 'status',
    ];

    protected $casts = ['published_at' => 'date', 'status' => 'boolean'];

    public function getDateAttribute(): string
    {
        return $this->published_at?->format('d M Y') ?? $this->created_at?->format('d M Y') ?? '';
    }
}
