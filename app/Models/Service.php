<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const CATEGORIES = [
        'development' => 'Development & Design',
        'crm' => 'CRM Solutions',
        'erp' => 'ERP Systems',
        'marketing' => 'Digital Marketing',
    ];

    protected $fillable = ['title', 'description', 'icon', 'link', 'sort_order', 'status', 'category'];

    protected $casts = [
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];
}
