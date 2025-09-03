<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAreas extends Model
{
    use HasFactory;

    protected $table = "hotel_areas";

    protected $fillable = [
        'hotel_id',
        'area_id'
    ];

    public function hotels() {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    public function areas() {
        return $this->belongsTo(Areas::class, 'area_id');
    }
}
