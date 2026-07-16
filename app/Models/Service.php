<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'link', 'sort_order', 'status'];

    protected $casts = [
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];
}
