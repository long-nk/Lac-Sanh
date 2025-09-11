<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'mime',
        'size',
        'path',
        'alt',
        'meta'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotels::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return asset('images/uploads/' . $this->path . '/' . $this->name);
    }

    /**
     * @return string
     */
    public function getUrlThumbsAttribute()
    {
        return asset('images/uploads/thumbs/'. $this->name);
    }
}
