<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function locations() {
        return $this->belongsToMany(Locations::class, 'location_areas', 'area_id', 'location_id');
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotels::class, 'hotel_areas', 'area_id', 'hotel_id');
    }

    public function listhotel($type, $location) {
        return $this->hotels()
            ->join('locations', 'hotels.location_id', 'locations.id')
            ->where('locations.id', $location)
            ->where('hotels.type', $type)
            ->where('hotels.status', 1)
            ->get();
    }


}
