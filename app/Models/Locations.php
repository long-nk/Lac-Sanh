<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;

    const BB = 0;
    const TN = 1;
    const TP = 2;
    const LM = 3;
    const TG = 4;

    protected $fillable = [
        'name',
        'country',
        'slug',
        'image',
        'rate',
        'summary',
        'location',
        'status',
        'sort',
        'region',
        'type',
        'check',
        'hidden'
    ];

    public function hotels() {
        return $this->hasMany(Hotels::class, 'location_id');
    }

    public function listhotel($id, $type) {
        if($type != '') {
            return Hotels::where('type', $type)->where('location_id', $id)->where('status', 1)->get();
        }
        return Hotels::where('location_id', $id)->where('status', 1)->get();
    }

    public function areas()
    {
        return $this->belongsToMany(Areas::class, 'location_areas', 'location_id', 'area_id');
    }

    public function banners($type)
    {
        return $this->hasMany(VillaBanners::class, 'location_id')
            ->where('type', $type)
            ->where('status', 1)
            ->orderBy('sort')
            ->orderByDesc('created_at');
    }
}
