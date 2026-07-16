<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = ['platform', 'url', 'icon', 'sort_order', 'status'];

    protected $casts = ['sort_order' => 'integer', 'status' => 'boolean'];
}
