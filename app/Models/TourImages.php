<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'name',
        'mime',
        'size',
        'path',
        'alt',
        'meta'
    ];

    public function tour()
    {
        return $this->belongsTo(Tours::class);
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
