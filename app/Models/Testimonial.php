<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'company',
        'review',
        'rating',
        'avatar',
        'sort_order',
        'is_active',
        'status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'status' => 'integer',
        'rating' => 'integer',
        'sort_order' => 'integer',
    ];
}
