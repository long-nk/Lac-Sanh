<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
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
        'stores',
        'notes',
        'list_comfort',
        'room',
        'booked_room',
        'people',
        'people_min',
        'bedroom',
        'bed',
        'mattress',
        'bathroom',
        'breakfast',
        'cancel',
        'surcharge',
        'type_room',
        'vat',
        'sort',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(HotelImages::class, 'hotel_id');
    }

    public function comforts()
    {
        return $this->belongsToMany(Comforts::class, 'hotel_comforts', 'hotel_id', 'comfort_id');
    }

    public function areas()
    {
        return $this->belongsToMany(Areas::class, 'hotel_areas', 'hotel_id', 'area_id');
    }

    public function vouchers()
    {
        return $this->belongsToMany(Vouchers::class, 'hotel_vouchers', 'hotel_id', 'voucher_id');
    }

    public function location() {
        return $this->belongsTo(Locations::class);
    }

    public function room() {
        return $this->hasMany(Rooms::class, 'hotel_id');
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
            'hotel_id', // Foreign key on comments table
            'comment_id', // Foreign key on comment_images table
            'id', // Local key on hotels table
            'id' // Local key on comments table
        )->with('commentImages')->union($this->images());
    }
}
