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

    public function cardImagePath(): string
    {
        $image = config('service_images.services')[$this->title]
            ?? config('service_images.defaults')[$this->category]
            ?? 'development-team';

        return 'frontend/assets/images/stock/'.$image.'.webp';
    }

    protected $casts = [
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];
}
