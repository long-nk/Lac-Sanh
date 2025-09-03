<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelComforts extends Model
{
    use HasFactory;

    protected $table = "hotel_comforts";

    protected $fillable = [
        'hotel_id',
        'comfort_id'
    ];

    public function hotels() {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    public function comforts() {
        return $this->belongsTo(Comforts::class, 'comfort_id');
    }
}
