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
        'logo_top',
        'logo_footer',
        'name',
        'full_name',
        'slogan',
        'summary',
        'copy_right',
        'phone_footer',
        'address',
        'address2',
        'phone_number',
        'phone_number2',
        'email',
        'mst',
        'image',
        'facebook',
        'messenger',
        'zalo',
        'tiktok',
        'twitter',
        'youtube',
        'linkedin',
        'instagram',
        'map',
        'header',
        'body',
        'footer',
        'css',
        'status',
        'qr_code',
        'bank',
        'account',
        'card',
        'content',
        'number',
        'set_index',
        'export_status',
        'link_website',
        'link_company',
        'mail_setup',
        'sale_name1',
        'sale_phone1',
        'sale_name2',
        'sale_phone2',
    ];
}
