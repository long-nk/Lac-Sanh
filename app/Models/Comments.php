<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = "comments";

    protected $fillable = [
        'name',
        'phone_number',
        'hotel_id',
        'tour_id',
        'title',
        'rate',
        'location',
        'price',
        'staff',
        'wc',
        'comfort',
        'message',
        'status'
    ];

    public function hotel() {
        return $this->belongsTo(Hotels::class, 'hotel_id');
    }

    public function tour() {
        return $this->belongsTo(Tours::class, 'tour_id');
    }

    public function images()
    {
        return $this->hasMany(CommentImages::class, 'comment_id');
    }

    public function commentImages()
    {
        return $this->hasMany(CommentImages::class, 'comment_id');
    }
}
