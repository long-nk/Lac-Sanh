<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageInfo extends Model
{
    use HasFactory;

    protected $table = "page_infos";

    protected $fillable = [
        'logo',
        'logo_mb',
        'name',
        'slogan',
        'address',
        'address2',
        'phone_number',
        'phone_number2',
        'email',
        'email2',
        'mst',
        'manager',
        'card',
        'bank',
        'account',
        'qr_code',
        'hotel',
        'villa',
        'resort',
        'homestay',
        'yacht',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'messenger'
    ];
}
