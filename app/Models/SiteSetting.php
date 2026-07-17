<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'logo',
        'css_version',
        'js_version',
        'contact_address',
        'contact_phone',
        'contact_email',
        'notification_emails',
    ];
}
