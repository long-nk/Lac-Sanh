<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_id',
        'slug',
        'address',
        'video',
        'price',
        'sale',
        'flash_sale',
        'description',
        'type',
        'rate',
        'date',
        'start_time',
        'activities',
        'list_comfort',
        'surcharge',
        'vat',
        'sort',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(TourImages::class, 'tour_id');
    }

    public function vouchers()
    {
        return $this->belongsToMany(Vouchers::class, 'tour_vouchers', 'tour_id', 'voucher_id');
    }

    public function location() {
        return $this->belongsTo(Locations::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class, 'hotel_id')->where('status', 1);
    }

    public function orders() {
        return $this->hasMany(Orders::class, 'hotel_id');
    }

    public function allImages()
    {
        return $this->hasManyThrough(
            CommentImages::class,
            Comments::class,
            'tour_id', // Foreign key on comments table
            'comment_id', // Foreign key on comment_images table
            'id', // Local key on hotels table
            'id' // Local key on comments table
        )->with('commentImages')->union($this->images());
    }
}
