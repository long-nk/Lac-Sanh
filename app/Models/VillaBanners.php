<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaBanners extends Model
{
    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const POPUP_SHOW = 1;
    const POPUP_NOT_SHOW = 0;

    protected $table = 'villa_banners';

    protected $fillable = [
        'name',
        'location_id',
        'link',
        'image_desktop',
        'image_mobile',
        'sort',
        'type',
        'status'
    ];

    public function villa()
    {
        return $this->belongsTo(Hotels::class, 'location_id');
    }

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
