<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourHotels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tour_id',
        'image',
        'time',
        'rate',
        'sort',
        'status'
    ];

    public function tour() {
        return $this->belongsTo(Tours::class);
    }

}
