<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationAreas extends Model
{
    use HasFactory;

    protected $table = "location_areas";

    protected $fillable = [
        'location_id',
        'area_id'
    ];

    public function locations() {
        return $this->belongsTo(Locations::class, 'location_id');
    }

    public function areas() {
        return $this->belongsTo(Areas::class, 'area_id');
    }
}
