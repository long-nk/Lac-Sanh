<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'name',
        'mime',
        'size',
        'path'
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class);
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
