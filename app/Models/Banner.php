<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const TYPE_BANNER = 1;
    const TYPE_KM = 2;
    const TYPE_SALE = 3;

    const TYPE_BANNER_VILLA = 4;

    const POPUP_SHOW = 1;
    const POPUP_NOT_SHOW = 0;

    protected $fillable = [
        'name',
        'link',
        'image',
        'sort',
        'type',
        'status'
    ];

    public function getUrlImageAttribute()
    {
        return asset($this->image);
    }

    public static function getTypeName($type)
    {
        $arrType = [
            self::TYPE_BANNER => trans('pdh.backend.banners.banner'),
            self::TYPE_KM => trans('pdh.backend.banners.km'),
        ];

        return !empty($type) ? $arrType[$type] : $arrType;
    }

    public function getTypeNameAttribute()
    {
        return self::getTypeName($this->type);
    }
}
