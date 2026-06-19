<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'category',
        'image_desktop',
        'image_tablet',
        'image_mobile',
        'project_url'
    ];
}
